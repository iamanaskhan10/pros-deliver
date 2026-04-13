<div class="modal fade" id="ChatLoginModal" tabindex="-1" aria-labelledby="ChatLoginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="#" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="ChatLoginModalLabel">
                        {{ __('Login to Chat') }}
                    </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="error-message"></div>
                    <div class="single-input">
                        <label class="label-title mb-2">{{ __('Email Or User Name') }}</label>
                        <input class="form--control" type="text" name="username" id="usernamechat"
                            placeholder="{{ __('Email Or User Name') }}">
                    </div>
                    <div class="single-input mt-4">
                        <label class="label-title mb-2"> {{ __('Password') }} </label>
                        <div class="single-input-inner">
                            <input class="form--control" type="password" name="password" id="passwordchat"
                                placeholder="{{ __('Type Password') }}">
                            <div class="icon toggle-password">
                                <div class="show-icon"> <i class="fas fa-eye-slash"></i> </div>
                                <span class="hide-icon"> <i class="fas fa-eye"></i> </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer flex-column">
                    <div class="d-flex flex-wrap gap-3">
                        <x-btn.submit :title="__('Login')" :class="'btn-profile btn-bg-1 login_to_continue_chat'" />
                    </div>
                    <div>
                        <div class="login-bottom-contents">
                            <div class="or-contents mb-3">
                                <span class="or-contents-para"> {{ __("Don't have a client account?") }} </span>
                            </div>
                            <div class="login-others">
                                <div class="login-others-single">
                                    <a href="{{ route('user.register') }}" target="_blank"
                                        class="login-others-single-btn w-100">
                                        <span class="login-para"> {{ __('Register Now') }} </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
