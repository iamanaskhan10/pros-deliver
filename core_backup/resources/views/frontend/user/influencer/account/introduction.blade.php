<!-- Setup Introduction Start -->
<div class="setup-wrapper-contents active">
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
