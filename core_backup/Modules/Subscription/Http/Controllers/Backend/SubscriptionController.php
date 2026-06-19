<?php

namespace Modules\Subscription\Http\Controllers\Backend;

use App\Models\AdminNotification;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Modules\Subscription\Entities\Subscription;
use Modules\Subscription\Entities\SubscriptionFeature;
use Modules\Subscription\Entities\SubscriptionType;
use Stripe\StripeClient;

class SubscriptionController extends Controller
{
    public function all_subscription()
    {
        $all_subscriptions = Subscription::with('subscription_type')->latest()->paginate(10);
        return view('subscription::backend.subscription.all-subscription', compact('all_subscriptions'));
    }

    public function add_subscription(Request $request)
    {
        if ($request->isMethod('post')) {
            $type = SubscriptionType::find($request->type);
            $request->validate([
                'type' => 'required',
                'title' => [
                    'required',
                    Rule::unique('subscriptions')->where(fn($query) => $query->where('subscription_type_id', $request->type)),
                    'max:191'
                ],
                'price' => [
                    'required',
                    function ($attribute, $value, $fail) use ($type) {
                        if ($type && !$type->isFree() && $value <= 0) {
                            $fail(__('The :attribute must be greater than 0 for paid subscription types.'));
                        }
                    },
                ],
                'limit' => 'required|gt:0',
                'logo' => 'required|exists:media_uploads,id',
                'feature' => 'required|array',
                'status' => 'nullable|array',
            ]);

            if ($request->file('logo')) {
                $request->validate([
                    'logo' => 'required|mimes:jpg,jpeg,png,bmp,tiff,svg|max:1024|dimensions:max_width=50,max_height=50',
                ]);
            }

            DB::beginTransaction();
            try {
                $stripeProductId = null;
                $stripePriceId = null;
                if (get_static_option('stripe_subscription_enabled') === 'on' && !$type->isFree()) {
                    // Initialize Stripe client
                    $stripe = new StripeClient(get_static_option('stripe_secret_key'));

                    // Get the site global currency
                    $currency = strtolower(get_static_option('site_global_currency') ?? 'usd');

                    // List of zero-decimal currencies (e.g., JPY)
                    $zeroDecimalCurrencies = ['jpy', 'krw', 'vnd', 'bif', 'clp', 'djf', 'gnf', 'kmf', 'mga', 'pyg', 'rwf', 'ugx', 'xof', 'xpf'];

                    // Determine unit amount based on currency
                    $unitAmount = in_array($currency, $zeroDecimalCurrencies)
                        ? (int) $request->price // No conversion for zero-decimal currencies
                        : (int) ($request->price * 100); // Convert to cents for other currencies

                    // Create Stripe product
                    $product = $stripe->products->create([
                        'name' => $request->title,
                        'description' => 'Subscription plan for ' . $request->title,
                        'active' => true,
                    ]);

                    // Create Stripe price with dynamic currency
                    $price = $stripe->prices->create([
                        'product' => $product->id,
                        'unit_amount' => $unitAmount,
                        'currency' => $currency,
                        'recurring' => [
                            'interval' => 'month',
                            'interval_count' => 1,
                        ],
                        'active' => true,
                    ]);

                    $stripeProductId = $product->id;
                    $stripePriceId = $price->id;
                }

                // Create subscription in database
                $subscription = Subscription::create([
                    'subscription_type_id' => $request->type,
                    'title' => $request->title,
                    'price' => $request->price,
                    'limit' => $request->limit,
                    'logo' => $request->logo ?? '',
                    'status' => 1,
                    'subscription_highlight_color' => 'no',
                    'stripe_product_id' => $stripeProductId,
                    'stripe_price_id' => $stripePriceId,
                ]);

                // Create subscription features
                $arr = [];
                foreach ($request->feature as $key => $attr) {
                    $arr[] = [
                        'subscription_id' => $subscription->id,
                        'feature' => $request->feature[$key] ?? '',
                        'status' => $request->status[$key] ?? 'off',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                $data = Validator::make($arr, ["*.feature" => "required"]);
                $data->validated();
                SubscriptionFeature::insert($arr);

                toastr_success(__('New Subscription Successfully Added'));
                DB::commit();
                return redirect()->back();
            } catch (Exception $e) {
                DB::rollBack();
                toastr_error(__('Failed to add subscription: ') . $e->getMessage());
                return redirect()->back();
            }
        }

        $all_types = SubscriptionType::all_types();
        return view('subscription::backend.subscription.add-subscription', compact('all_types'));
    }

    public function edit_subscription(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $type = SubscriptionType::find($request->type);
            $request->validate([
                'title' => [
                    'required',
                    Rule::unique('subscriptions')->where(fn($query) => $query->where('subscription_type_id', $request->type))->ignore($id),
                    'max:191'
                ],
                'type' => 'required',
                'price' => [
                    'required',
                    function ($attribute, $value, $fail) use ($type) {
                        if ($type && !$type->isFree() && $value <= 0) {
                            $fail(__('The :attribute must be greater than 0 for paid subscription types.'));
                        }
                    },
                ],
                'limit' => 'required|gt:0',
                'feature' => 'required|array',
                'status' => 'nullable|array',
                'logo' => 'required',
            ], [
                'title.unique' => __('Title already exists for this subscription type')
            ]);

            if ($request->file('logo')) {
                $request->validate([
                    'logo' => 'required|mimes:jpg,jpeg,png,bmp,tiff,svg|max:1024|dimensions:max_width=50,max_height=50'
                ]);
            }

            DB::beginTransaction();
            try {
                $subscription = Subscription::findOrFail($id);
                $stripe = null;
                $newPriceId = $subscription->stripe_price_id;

                // Check if Stripe subscriptions are enabled and the subscription is not free
                if (get_static_option('stripe_subscription_enabled') === 'on' && !$type->isFree()) {
                    $stripe = new StripeClient(get_static_option('stripe_secret_key'));

                    // Get the site global currency
                    $currency = strtolower(get_static_option('site_global_currency') ?? 'usd');

                    // List of zero-decimal currencies (e.g., JPY)
                    $zeroDecimalCurrencies = ['jpy', 'krw', 'vnd', 'bif', 'clp', 'djf', 'gnf', 'kmf', 'mga', 'pyg', 'rwf', 'ugx', 'xof', 'xpf'];

                    // Update Stripe product if it exists
                    if ($subscription->stripe_product_id) {
                        $stripe->products->update($subscription->stripe_product_id, [
                            'name' => $request->title,
                            'description' => 'Subscription plan for ' . $request->title,
                        ]);
                    }

                    // Check if price needs updating
                    if ($subscription->price != $request->price && $subscription->stripe_product_id) {
                        // Deactivate old price (optional, to prevent it from being used for new subscriptions)
                        if ($subscription->stripe_price_id) {
                            $stripe->prices->update($subscription->stripe_price_id, ['active' => false]);
                        }

                        // Determine unit amount based on currency
                        $unitAmount = in_array($currency, $zeroDecimalCurrencies)
                            ? (int) $request->price // No conversion for zero-decimal currencies
                            : (int) ($request->price * 100); // Convert to cents for other currencies

                        // Create new price
                        $newPrice = $stripe->prices->create([
                            'product' => $subscription->stripe_product_id,
                            'unit_amount' => $unitAmount,
                            'currency' => $currency,
                            'recurring' => [
                                'interval' => 'month',
                                'interval_count' => 1,
                            ],
                            'active' => true,
                        ]);
                        $newPriceId = $newPrice->id;
                    }
                }

                // Update subscription in database
                $subscription->update([
                    'subscription_type_id' => $request->type,
                    'title' => $request->title,
                    'price' => $request->price,
                    'limit' => $request->limit,
                    'logo' => $request->logo ?? '',
                    'stripe_price_id' => $newPriceId, // Update with new price ID if created
                ]);

                // Update subscription features
                SubscriptionFeature::where('subscription_id', $id)->delete();
                $arr = [];
                foreach ($request->feature as $key => $attr) {
                    $arr[] = [
                        'subscription_id' => $id,
                        'feature' => $request->feature[$key] ?? '',
                        'status' => $request->status[$key] ?? 'off',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                $data = Validator::make($arr, ["*.feature" => "required"]);
                $data->validated();
                SubscriptionFeature::insert($arr);

                toastr_success(__('Subscription Successfully Updated'));
                DB::commit();
            } catch (\Stripe\Exception\ApiErrorException $e) {
                DB::rollBack();
                toastr_error(__('Stripe API error: ') . $e->getMessage());
                return redirect()->back();
            } catch (Exception $e) {
                DB::rollBack();
                toastr_error(__('Failed to update subscription: ') . $e->getMessage());
                return redirect()->back();
            }
        }

        $all_types = SubscriptionType::all_types();
        $subscription_details = Subscription::with('features')->where('id', $id)->first();
        return !empty($subscription_details) ? view('subscription::backend.subscription.edit-subscription', compact('all_types', 'subscription_details')) : back();
    }


    // search category
    public function search_subscription(Request $request)
    {
        $all_subscriptions = Subscription::whereHas('subscription_type', function ($query) use ($request) {
            $query->where('type', 'LIKE', "%" . strip_tags($request->string_search) . "%");
        })
            ->with(['subscription_type' => function ($query) use ($request) {
                $query->where('type', 'LIKE', "%" . strip_tags($request->string_search) . "%");
            }])
            ->paginate(10);
        return $all_subscriptions->total() >= 1 ? view('subscription::backend.subscription.search-result', compact('all_subscriptions'))->render() : response()->json(['status' => __('nothing')]);
    }

    // pagination
    function pagination(Request $request)
    {
        if ($request->ajax()) {
            $request->string_search == ''
                ? $all_subscriptions = Subscription::with('subscription_type')->latest()->paginate(10)
                : $all_subscriptions = Subscription::whereHas('subscription_type', function ($query) use ($request) {
                    $query->where('type', 'LIKE', "%" . strip_tags($request->string_search) . "%");
                })
                ->with(['subscription_type' => function ($query) use ($request) {
                    $query->where('type', 'LIKE', "%" . strip_tags($request->string_search) . "%");
                }])
                ->paginate(10);
            return view('subscription::backend.subscription.search-result', compact('all_subscriptions'))->render();
        }
    }

    // delete subscription
    public function delete_subscription($id)
    {
        $subscription = Subscription::find($id);
        $subscription_users = $subscription->user_subscriptions?->count();
        if ($subscription_users == 0) {
            $subscription->delete();
            return back()->with(toastr_error(__('Subscription Successfully Deleted')));
        } else {
            return back()->with(toastr_error(__('Subscription is not deletable because it is related to user subscriptions')));
        }
    }

    // bulk action subscription
    public function bulk_action_subscription(Request $request)
    {
        foreach ($request->ids as $subscription_id) {
            $subscription = Subscription::find($subscription_id);
            $subscription_users = $subscription->user_subscriptions?->count();
            if ($subscription_users == 0) {
                $subscription->delete();
            }
        }
        return back()->with(toastr_error(__('Selected Subscriptions Successfully Deleted')));
    }

    // change subscription status
    public function status($id)
    {
        $subscription = Subscription::select('status')->where('id', $id)->first();
        $subscription->status == 1 ? $status = 0 : $status = 1;
        Subscription::where('id', $id)->update(['status' => $status]);
        return redirect()->back()->with(toastr_success(__('Status Successfully Changed')));
    }

    public function hilight_color($id)
    {
        $subscription = Subscription::select('subscription_highlight_color')->where('id', $id)->first();
        Subscription::query()->update(['subscription_highlight_color' => 'no']);
        Subscription::where('id', $id)->update(['subscription_highlight_color' => 'yes']);
        return redirect()->back()->with(toastr_success(__('Status Successfully Changed')));
    }
}
