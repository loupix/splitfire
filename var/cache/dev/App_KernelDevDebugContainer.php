<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\Container5GhLXzr\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/Container5GhLXzr/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/Container5GhLXzr.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\Container5GhLXzr\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \Container5GhLXzr\App_KernelDevDebugContainer([
    'container.build_hash' => '5GhLXzr',
    'container.build_id' => '026280a0',
    'container.build_time' => 1593637837,
], __DIR__.\DIRECTORY_SEPARATOR.'Container5GhLXzr');
