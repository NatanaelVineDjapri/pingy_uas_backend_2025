 

<?php $__env->startSection('head'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/styleHome.css')); ?>">
    <?php echo $__env->yieldContent('head'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="tweet-container">
    <div class="tweet-list">
        <?php $__currentLoopData = $tweets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tweet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="tweet-item">
            <div class="tweet-header">
                 <?php if($tweet->user->avatar): ?>
                    <img src="<?php echo e(asset('storage/' . $tweet->user->avatar)); ?>" class="avatar">
                <?php else: ?>
                    <img src="<?php echo e(asset('image/profilepicture.jpg')); ?>" class="avatar">
                <?php endif; ?>
                <div class="packs-name">
                    <p class="name"><?php echo e($tweet->user->name); ?></p> 
                    <p class="username"><?php echo e('@' . $tweet->user->username); ?> - <?php echo e($tweet->created_at->format('M,d Y')); ?></p>
                </div>
            </div>
            <div class="tweet-body">
                <p><?php echo e($tweet->body); ?></p>
                <?php if($tweet->tweetImage): ?>
                <div class="tweet-image">
                    <img src="<?php echo e(asset('storage/' . $tweet->tweetImage)); ?>"  alt="Tweet image" style="width: 100%; max-width: 675px;max-height:500px;border-radius: 10px; margin-top: 10px;">
                </div>
                <?php endif; ?>
                <ul class="retweeticons">
                    <a href="<?php echo e(route('showcomment', ['tweet' => $tweet->id])); ?>"><ion-icon name="chatbubble-ellipses-outline"></ion-icon></a>
                    <span><?php echo e($tweet->comments_count); ?></span>

                    <ion-icon name="repeat-outline"></ion-icon>
                    <span><?php echo e($tweet->comments_count); ?></span>
                            
                    <?php
                        $liked = auth()->user()->likedTweets->contains($tweet->id);
                    ?>
                    <form action="<?php echo e(route('liketweet',$tweet->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php if($liked): ?>
                            <button type="submit" class="like-btn"><ion-icon name="heart-outline" ></ion-icon></button>
                        <?php else: ?>
                            <button type="submit" class="like-btn"><ion-icon name="heart-half-outline" ></ion-icon></button>
                        <?php endif; ?>
                    </form>
                    <span><?php echo e($tweet->likes_count); ?></span>

                    <ion-icon name="bookmark-outline"></ion-icon>
                    <span><?php echo e($tweet->comments_count); ?></span>
                </ul>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\UAS_BACKEND\pingy\resources\views/home.blade.php ENDPATH**/ ?>