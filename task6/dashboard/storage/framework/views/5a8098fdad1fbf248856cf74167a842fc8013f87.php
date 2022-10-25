<?php $__env->startSection('title', "Create New Product"); ?>


<?php $__env->startSection('content'); ?>

<div class="col-12">

    <form action="<?php echo e(asset('dashboard/products/insert')); ?>" method="post" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="form-row my-2">
            <div class="col-6">
                <label for="name_en"> Name En</label>
                <input type="text" name="name_en" id="name_en" value="<?php echo e(old('name_en')); ?>" class="form-control">
                <?php $__errorArgs = ['name_en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-danger my-2"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-6">
                <label for="name_ar"> Name Ar</label>
                <input type="text" name="name_ar" id="name_ar" value="<?php echo e(old('name_ar')); ?>"  class="form-control">
                <?php $__errorArgs = ['name_ar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-danger my-2"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
        <div class="form-row my-2">
            <div class="col-6">
                <label for="price"> Price </label>
                <input type="text" name="price" id="price" value="<?php echo e(old('price')); ?>"  class="form-control">
                <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-danger my-2"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-6">
                <label for="quantity"> Quantity </label>
                <input type="text" name="quantity" id="quantity" value="<?php echo e(old('quantity')); ?>"  class="form-control">
                <?php $__errorArgs = ['quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-danger my-2"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
        <div class="form-row my-2">
            <div class="col-4">
                <label for="status"> Status </label>
                <select name="status" id="status" class="form-control">
                    <option <?php if(old('status') === 1 ): echo 'selected'; endif; ?> value="1">Active</option>
                    <option <?php if(old('status') === 0 ): echo 'selected'; endif; ?> value="0">Not Active</option>
                </select>
                <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-danger my-2"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-4">
                <label for="brand"> Brands </label>
                <select name="brand_id" id="brand" class="form-control">
                    <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option <?php if(old('brand') == $brand->id ): echo 'selected'; endif; ?> value="<?php echo e($brand->id); ?>"><?php echo e($brand->name_en); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['brand'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-danger my-2"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-4">
                <label for="subcategory"> Subcategory </label>
                <select name="subcategory_id" id="subcategory" class="form-control">
                    <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option  <?php if(old('subcategory') == $subcategory->id ): echo 'selected'; endif; ?>  value="<?php echo e($subcategory->id); ?>"><?php echo e($subcategory->name_en); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['subcategory'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-danger my-2"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
        <div class="form-row my-2">
            <div class="col-6">
                <label for="details_en"> Details En</label>
                <textarea name="details_en" id="details_en" class="form-control" cols="30" rows="10"><?php echo e(old('details_en')); ?></textarea>
                <?php $__errorArgs = ['details_en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-danger my-2"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-6"">
                <label for=" details_ar"> Details Ar</label>
                <textarea name="details_ar" id="details_ar" class="form-control" cols="30" rows="10"><?php echo e(old('details_ar')); ?></textarea>
                <?php $__errorArgs = ['details_ar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-danger my-2"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
        <div class="form-row my-2">
            <div class="col-6">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control">
                <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-danger my-2"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
        <div class="form-row my-2">
            <div class="col-2">
                <button class="btn btn-primary">Create</button>
            </div>
        </div>
    </form>

</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.parent', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projects\php_nti\task6\dashboard\resources\views/products/create.blade.php ENDPATH**/ ?>