 

<?php $__env->startSection('head'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/styleProfileShowEdit.css')); ?>">
    <?php echo $__env->yieldContent('head'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="flexcontainer">
    <div class="middlecontainer">
        <section class="headsec">
            <div class="header-title">
                <a href="#" class="item-icon"><ion-icon name="arrow-back-outline"></ion-icon></a>
                <a href="#" class="item-link"><?php echo e($user->name); ?></a>
            </div>
        </section>
        <section class="twitterprofile">
            <div class="headerprofileimage">
                <?php if($user->banner): ?>
                <img src="<?php echo e(asset('storage/' . $user->banner)); ?>" alt="header" id="headerimage">
                <?php else: ?>
                <img src="<?php echo e(asset('image/banner.jpg')); ?>" alt="header default" id="headerimage">
                <?php endif; ?>

                <?php if($user->avatar): ?>
                <img src="<?php echo e(asset('storage/' . $user->avatar)); ?>" alt="profile pic" id="profilepic">
                <?php else: ?>
                <img src="<?php echo e(asset('image/profilepicture.jpg')); ?>" alt="profile pic" id="profilepic">
                <?php endif; ?>
               
                <div class="editprofile">
                    <?php if(Auth::id() == $user->id): ?>
                        <a href="<?php echo e(route('editprofile', $user->id)); ?>">Edit Profile</a>
                    <?php else: ?>
                         <form action="<?php echo e(route('follow',$user)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php if(auth()->user()->isFollowing($user)): ?>
                        <button type="submit" class="follow-btn">UnFollow</button>
                    <?php else: ?>
                        <button type="submit" class="follow-btn">Follow</button>
                    <?php endif; ?>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
            <div class="bio">
                <div class="handle">
                    <h3><?php echo e($user->name); ?></h3>
                    <p><?php echo e('@' .$user->username); ?></p>
                </div>
                <p><?php echo e($user->description); ?></p>
                <span>
                    <i class="fa fa-calendar"></i> Joined <?php echo e($user->created_at->format('F Y')); ?>

                </span>
                <div class="nawa">
                    <div class="followers"> <?php echo e($user->following_count); ?> <span>Following</span></div>
                    <div><?php echo e($user->followers_count); ?><span> Followers</span></div>
                </div>
            </div>
        </section>
        <section class="tweets">
            <div class="heading">
                <a href=""><p>Tweets</p></a>
                <a href=""><p>Tweets and Replies</p></a>
                <a href=""><p>Media</p><a>
                <a><p>Likes</p><a>
            </div>
        </section>
        <section class="mytweets">
            <?php $__currentLoopData = $tweets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tweet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="tweet">
                    <div>
                    <?php if($user->avatar): ?>
                        <img src="<?php echo e(asset('storage/' . $user->avatar)); ?>" class="avi">
                    <?php else: ?>
                        <img src="<?php echo e(asset('image/profilepicture.jpg')); ?>" class="avi">
                    <?php endif; ?>
                    </div>
                    <div class="tweetbody">
                        <div class="packs-name">
                            <p class="name"><?php echo e($user->name); ?></p> 
                            <p class ="username"><?php echo e('@'. $user->username); ?> - <?php echo e($tweet->created_at->format('M,d Y')); ?></p>
                        </div>
                        <div class="tweetcontent"><?php echo e($tweet->body); ?></div>
                        <?php if($tweet->tweetImage): ?>
                            <div class="tweet-image">
                                <img src="<?php echo e(asset('storage/' . $tweet->tweetImage)); ?>" alt="Tweet image" style="max-width: 80%; border-radius: 10px; margin-top: 10px;">
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
                                        <button type="submit" class="delete-btn"><ion-icon name="heart-outline" style="color:white"></ion-icon></button>
                                    <?php else: ?>
                                        <button type="submit" class="delete-btn"><ion-icon name="heart-outline" style="color:pink"></ion-icon></button>
                                    <?php endif; ?>
                                    </form>
                                    <span><?php echo e($tweet->likes_count); ?></span>
                            <ion-icon name="bookmark-outline"></ion-icon>
                             <span><?php echo e($tweet->likes_count); ?></span>

                             <form action="<?php echo e(route('deletetweet', $tweet->id)); ?>" method="POST" onsubmit="return confirm('Are you sure to delete this tweet?');" class ="delete-form">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="delete-btn"><ion-icon name="trash-outline"></ion-icon></button>
                            </form>
                            <a href="<?php echo e(route('edittweet', $tweet->id)); ?>" class="edit-btn">
                                <ion-icon name="create-outline"></ion-icon>
                            </a>
                            <?php if($tweet->updated_at != $tweet->created_at): ?>
                                <small style="color:gray; font-style:italic;">(edited)</small>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </section>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\UAS_BACKEND\pingy\resources\views/profiles/profile-show.blade.php ENDPATH**/ ?>