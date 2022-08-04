                  
                    
                    <?php if($paginator->hasPages()): ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="pagination pagination-rounded justify-content-center mt-4">
            
            <?php if($paginator->onFirstPage()): ?>
                <li class="disabled page-item" aria-disabled="true" aria-label="<?php echo app('translator')->get('pagination.previous'); ?>">
                <a href="#" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                </li>
            <?php else: ?>
                <li class="page-item">
                    <a href="<?php echo e($paginator->previousPageUrl()); ?>" class="page-link" rel="prev" aria-label="<?php echo app('translator')->get('pagination.previous'); ?>">
                    <i class="mdi mdi-chevron-left"></i>
                    </a>
                </li>
            <?php endif; ?>

            
            <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                <?php if(is_string($element)): ?>
                    <li class="disabled" class="page-item" aria-disabled="true"><a href="#" class="page-link"><span><?php echo e($element); ?></span></a></li>
                <?php endif; ?>

                
                <?php if(is_array($element)): ?>
                    <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($page == $paginator->currentPage()): ?>
                            <li class="active page-item" aria-current="page"><a href="#" class="page-link"><span><?php echo e($page); ?></span></a></li>
                        <?php else: ?>
                            <li class="page-item"><a class="page-link" href="<?php echo e($url); ?>"><?php echo e($page); ?></a></li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            
            <?php if($paginator->hasMorePages()): ?>
                <li class="page-item">
                    <a class="page-link" href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next" aria-label="<?php echo app('translator')->get('pagination.next'); ?>">&rsaquo;</a>
                </li>
            <?php else: ?>
                <li class="disabled page-item" aria-disabled="true" aria-label="<?php echo app('translator')->get('pagination.next'); ?>">
                <a href="#" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                </li>
            <?php endif; ?>
            </ul>
                        </div>
                    </div>
<?php endif; ?>
<?php /**PATH /opt/lampp/htdocs/setupfx-admin-master/resources/views/components/pagination.blade.php ENDPATH**/ ?>