<?php $__env->startSection('title'); ?>
    <?php echo e(__('All Plugins')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <style>
        .plugin-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 1em;
        }

        .plugin-card {
            width: calc((100% - 2em) / 3);  /* for a three column layout */
            box-shadow: 0px 1px 3px 0px rgba(0,0,0,0.2);
            /*padding: 1em;*/
            text-align: center;
        }
        .plugin-card .thumb-bg-color {
            background-color: #009688;
            padding: 40px;
            color: #fff;
        }

        .plugin-card .thumb-bg-color strong {
            font-size: 20px;
            line-height: 26px;
        }

        .plugin-card .thumb-bg-color strong .version {
            font-size: 14px;
            line-height: 18px;
            background-color: #fff;
            padding: 5px 10px;
            display: inline-block;
            color: #333;
            border-radius: 3px;
            margin-top: 15px;
        }

        .plugin-title {
            font-size: 16px;
            font-weight: 500;
            background-color: #03A9F4;
            box-shadow: 0 0 30px 0 rgba(0,0,0,0.2);
            display: inline-block;
            padding: 12px 30px;
            border-radius: 25px;
            color: #fff;
            position: relative;
            margin-top: -20px;
        }
        .plugin-title.externalplugin {
            background-color: #3F51B5;
        }
        .plugin-meta {
            font-size: 0.9em;
            color: #666;
            padding: 20px;
        }
        .padding-30{
            padding: 30px;
        }
        .plugin-card .thumb-bg-color.externalplugin {
            background-color: #FF9800;
        }

        .plugin-card .plugin-meta {
            min-height: 50px;
        }
        .plugin-card .btn-group-wrap {
            margin-bottom: 30px;
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        .plugin-card .btn-group-wrap a {
            display: inline-block;
            padding: 8px 25px;
            background-color: #4b4e5b;
            border-radius: 25px;
            color: #fff;
            text-decoration: none;
            font-size: 12px;
            transition: all 300ms;
        }

        .plugin-card .btn-group-wrap a.pl_delete {
            background-color: #e13a3a;
        }
        .plugin-card .btn-group-wrap a:hover{
            opacity: .8;
        }
        /* For large screens and above */
        @media (min-width: 900px) {
            .plugin-card {
                width: calc((100% - 3em) / 3);  /* three columns for large screens */
            }
        }

        /* For medium screens and above */
        @media (max-width: 600px) {
            .plugin-card {
                width: calc((100% - 2em) / 2);  /* two columns for medium screens */
            }
            .plugin-card .btn-group-wrap {
                gap: 5px;
            }
            .plugin-card .btn-group-wrap a {
                padding: 7px 15px;
            }
            .plugin-title {
                font-size: 12px;
                line-height: 16px;
            }
        }
        @media (max-width: 500px) {
            .plugin-card {
                width: calc((100% - 2em) / 1);  /* two columns for medium screens */
            }
            .plugin-title {
                font-size: 16px;
                line-height: 20px;
            }
        }



    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="dashboard__body">
        <div class="row">
            <div class="col-md-12">
                <div class="recent-order-wrapper dashboard-table bg-white padding-30">
                    <div class="header-wrap">
                        <h4 class="header-title mb-2"><?php echo e(__("All Plugins")); ?></h4>
                        <p class="mb-2"><?php echo e(__("Manage all plugins from here, you can active/deactivate plugin or can delete any plugin from here")); ?></p>
                    </div>
                    <div class="plugin-grid">
                    <?php $__currentLoopData = $pluginList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plugin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="plugin-card">
                                <div class="thumb-bg-color <?php echo e(\Illuminate\Support\Str::slug($plugin->category,null,"_")); ?>">
                                    <strong class="<?php echo e(\Illuminate\Support\Str::slug($plugin->category,null,"_")); ?>">  <?php echo e($plugin->name); ?>  <p><span class="version"><?php echo e($plugin->version); ?></span></p></strong>
                                </div>
                                <h3 class="plugin-title <?php echo e(\Illuminate\Support\Str::slug($plugin->category,null,"_")); ?>"><?php echo e($plugin->category); ?></h3>
                                <p class="plugin-meta">
                                    <?php if(!empty($plugin->description)): ?>
                                        <?php echo e($plugin->description); ?>

                                    <?php else: ?>
                                        <?php echo e($plugin->name." ".sprintf(__("is a %s developed by %s to enhance platform features"),$plugin->category,(\Illuminate\Support\Str::slug($plugin->category,null,"_") === "coreplugin" ? __("Core Team") : __("External Developer")))); ?>

                                    <?php endif; ?>
                                </p>
                                <div class="btn-group-wrap">
                                    <?php if($plugin->external): ?>
                                        <a href="#" data-status="<?php echo e($plugin->status ? 1 : 0); ?>" data-plugintype="<?php echo e($plugin->category); ?>" data-plugin="<?php echo e($plugin->name); ?>" class="pl-btn pl_active_deactive"><?php echo e($plugin->status ? __("Deactivate") : __("Active")); ?></a>
                                        <a href="#" data-plugintype="<?php echo e($plugin->category); ?>" data-plugin="<?php echo e($plugin->name); ?>" class="pl-btn pl_delete"><?php echo e(__("Delete")); ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <?php if (isset($component)) { $__componentOriginal54c16274d3d0b2e3d7bba6b79dadebcb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal54c16274d3d0b2e3d7bba6b79dadebcb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sweet-alert.sweet-alert2-js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sweet-alert.sweet-alert2-js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal54c16274d3d0b2e3d7bba6b79dadebcb)): ?>
<?php $attributes = $__attributesOriginal54c16274d3d0b2e3d7bba6b79dadebcb; ?>
<?php unset($__attributesOriginal54c16274d3d0b2e3d7bba6b79dadebcb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal54c16274d3d0b2e3d7bba6b79dadebcb)): ?>
<?php $component = $__componentOriginal54c16274d3d0b2e3d7bba6b79dadebcb; ?>
<?php unset($__componentOriginal54c16274d3d0b2e3d7bba6b79dadebcb); ?>
<?php endif; ?>
    <script>
        (function ($){
            "use strict";

            /**
             * handle plugin active deactivate option
             * */
            $(document).on("click",".pl_active_deactive",function(e){
                e.preventDefault();
                var el = $(this);
                let allData = el.data();
                // check warning based on plugin type
                var swalDesc =  '<?php echo e(__("it will disabled the features you are enjoying from")); ?> ' +allData.plugin + " <?php echo e(__("plugin!")); ?>";
                var swalBtnText = allData.status == 1 ? "<?php echo e(__('Yes, deactivate it!')); ?>" : "<?php echo e(__('Yes, active it!')); ?>";
                var buttonText = allData.status !== 1 ? "<?php echo e(__('Deactivate')); ?>" : "<?php echo e(__('Active')); ?>";
                if(allData.plugintype === "Core Plugin" ){
                    swalDesc = allData.plugin+" <?php echo e(__('is a core plugin, after deactivate it you might face issues or error in the website')); ?>";
                }
                if(allData.status === 0 ){
                    var title = "<?php echo e(__("Are you sure to activate")); ?>"
                }else{
                    var title = "<?php echo e(__("Are you sure to deactivate")); ?>"
                }

                if(allData.status == 0){
                    swalDesc = "<?php echo e(__("you are activating a new plugin..")); ?>"
                }
                Swal.fire({
                    title: title + ' '+allData.plugin+" <?php echo e(__("plugin ?")); ?>",
                    text:swalDesc,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: swalBtnText,
                    cancelButtonText: "<?php echo e(__('Cancel')); ?>",

                }).then((result) => {
                    if (result.isConfirmed) {
                        //hide the plugin from the page
                        // send ajax request to backend to delete plugin
                        $('.pl_active_deactive[data-plugin="'+allData.plugin+'"]').text(buttonText);
                        $.ajax({
                            url: "<?php echo e(route('admin.plugin.manage.status.change')); ?>",
                            type: "post",
                            data: {
                                _token : "<?php echo e(csrf_token()); ?>",
                                plugin : allData.plugin,
                                status : allData.status,
                            },
                            success: function (data){
                                location.reload();
                            }
                        })
                    }
                });
            });

            /**
            * handle plugin delete option
            * */
            $(document).on("click",".pl_delete",function(e){
                e.preventDefault();
               var el = $(this);
               let allData = el.data();
                // check warning based on plugin type
                if(allData.plugintype === "Core Plugin" ){
                   Swal.fire({
                       icon: 'error',
                       title:"<?php echo e(__("Oops...")); ?>",
                       text: "<?php echo e(__("you can not delete any core plugin")); ?>",
                       timer: 3000,
                       timerProgressBar: true,
                   })
                   return;
               }
                Swal.fire({
                    title: '<?php echo e(__("Are you sure to delete")); ?> '+allData.plugin+" <?php echo e(__("plugin ?")); ?>",
                    text: '<?php echo e(__("You would not be able to restore")); ?> ' +allData.plugin + " <?php echo e(__("plugin again!")); ?>",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "<?php echo e(__('Yes, Delete it!')); ?>",
                    cancelButtonText: "<?php echo e(__('Cancel')); ?>",

                }).then((result) => {
                    if (result.isConfirmed) {
                        // hide the plugin from the page
                        // send ajax request to backend to delete plugin
                        $('.pl_delete[data-plugin="'+allData.plugin+'"]').parent().parent().hide();
                        $.ajax({
                            url: "<?php echo e(route('admin.plugin.manage.delete')); ?>",
                            type: "post",
                            data: {
                                _token : "<?php echo e(csrf_token()); ?>",
                                plugin : allData.plugin,
                            },
                            success: function (data){
                                location.reload();
                            }
                        })
                    }
                });
            });

        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/prosdeliver/public_html/core/Modules/PluginManage/Resources/views/plugin-manage/index.blade.php ENDPATH**/ ?>