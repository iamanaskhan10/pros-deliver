<!-- Setup Skills Starts -->
<div class="setup-wrapper-contents">
    <div class="setup-wrapper-contents-item">
        <h3 class="setup-wrapper-contents-title"> {{ get_static_option('language_title') ?? __('Great! Now add some language you have') }} </h3>
        <div class="setup-wrapper-skill">
            <p class="setup-wrapper-skill-para">{{ __('Type and hit ↵ Enter to add a language.') }}</p>
            <div class="setup-wrapper-skill-tagInputs mt-4">
                <input type="text" id="lang_input">
            </div>
        </div>
    </div>

    <div class="setup-wrapper-contents-item">
        <ul class="setup-wrapper-work-list">
            @php
                $languages = \App\Models\Language::all();
                $user_languages =  \App\Models\UserLang::select('lang')->where('user_id',Auth::guard('web')->user()->id)->first()->lang ?? '';
                $array_lang = explode(",",$languages);
                $all_languages = \App\Models\Language::select('name')->where('status','publish')->get();
            @endphp
            @if($all_languages)
                @foreach($all_languages as $lang)
                    @if(!in_array($lang->name, $array_lang))
                        <li class="setup-wrapper-work-list-item choose_lang"> {{ $lang->name }} </li>
                    @endif
                @endforeach
            @endif
        </ul>
    </div>
</div>
<!-- Setup Skills Ends -->