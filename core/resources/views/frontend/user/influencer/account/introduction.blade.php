<!-- Setup Introduction Start -->
<div class="setup-wrapper-contents active">
    {{-- AI Profile Enhancer --}}
    <div style="display:flex;justify-content:flex-end;margin-bottom:16px;">
        <button id="ai-enhance-profile-btn"
                style="background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;border:none;border-radius:8px;padding:8px 18px;font-size:13px;font-weight:600;cursor:pointer;display:flex;align-items:center;gap:6px;">
            <span id="ai-enhance-spinner" style="width:14px;height:14px;border:2px solid rgba(255,255,255,.4);border-top-color:#fff;border-radius:50%;animation:ai-spin .6s linear infinite;display:none;"></span>
            <span id="ai-enhance-btn-text">✨ {{ __('Enhance Bio with AI') }}</span>
        </button>
    </div>
    <style>@keyframes ai-spin{to{transform:rotate(360deg)}}</style>
    <div class="setup-wrapper-contents-item">
        <h3 class="setup-wrapper-contents-title">{{ get_static_option('intro_title2') ?? __('What\'s your gender?') }}</h3>
        <div class="setup-wrapper-contents-form">
            <div class="setup-wrapper-contents-form-item">
                @if(!empty(Auth::guard('web')->user()->gender))
                    <input type="radio" name="male_female" value="male" {{ Auth::guard('web')->user()->gender == 'male' ? 'checked' : ''  }}> {{ __('Male') }}
                    <input type="radio" name="male_female" value="female" {{ Auth::guard('web')->user()->gender == 'female' ? 'checked' : ''  }}> {{ __('Female') }}
                    <input type="radio" name="male_female" value="others" {{ Auth::guard('web')->user()->gender == 'others' ? 'checked' : ''  }}> {{ __('Others') }}
                @else
                    <input type="radio" name="male_female" value="male" checked }}> {{ __('Male') }}
                    <input type="radio" name="male_female" value="female"> {{ __('Female') }}
                    <input type="radio" name="male_female" value="others"> {{ __('Others') }}
                @endif
                <input type="hidden" id="gender" value="male">
            </div>
        </div>
    </div>
    <div class="setup-wrapper-contents-item">
        <h3 class="setup-wrapper-contents-title">{{ get_static_option('intro_title') ?? __('Provide an short intro about yourself within 250 character.') }}</h3>
        <div class="setup-wrapper-contents-form">
            <div class="setup-wrapper-contents-form-item">
                <textarea name="description" id="description" class="form-message" cols="30" rows="3" placeholder="{{ __('I am a influencer relations manager...') }}">@if(!empty($user_introduction)) {{$user_introduction->description}} @endif</textarea>
            </div>
        </div>
    </div>
</div>
<!-- Setup Introduction Ends -->
