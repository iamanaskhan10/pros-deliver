<div class="listing-page all-blog-page-wraper">
    <div class="title-with-searchbar-part-wraper">
        <h2 class="inf-title title6 fw_bold balck_text">{{ __('All Blogs') }}</h2>
        <div class="searchbar-wraper justify-content-end">
            <div class="all-blog-searchbar-wraper">
                <x-form.category-dropdown :title="''" :name="'category'" :id="'blog-category'" :class="'form-control'" :selectType="'alternative'"/>
            </div>
        </div>
    </div>
</div>
