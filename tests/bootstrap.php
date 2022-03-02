<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
use Hyperf\Config\Listener\RegisterPropertyHandlerListener;
use Hyperf\Di\Aop\PropertyHandlerVisitor;
use Hyperf\Di\Aop\ProxyCallVisitor;

! defined('BASE_PATH') && define('BASE_PATH', dirname(__DIR__, 1));
! defined('SWOOLE_HOOK_FLAGS') && define('SWOOLE_HOOK_FLAGS', SWOOLE_HOOK_ALL);

require_once BASE_PATH . '/vendor/autoload.php';

if (class_exists(\Hyperf\Di\Aop\AstVisitorRegistry::class)) {
    // Register AST visitors to the collector.
    \Hyperf\Di\Aop\AstVisitorRegistry::insert(PropertyHandlerVisitor::class, PHP_INT_MAX / 2);
    \Hyperf\Di\Aop\AstVisitorRegistry::insert(ProxyCallVisitor::class, PHP_INT_MAX / 2);
}

if (class_exists(\Hyperf\Di\Aop\RegisterInjectPropertyHandler::class)) {
    // Register Property Handler.
    \Hyperf\Di\Aop\RegisterInjectPropertyHandler::register();
}

(new RegisterPropertyHandlerListener())->process(new \stdClass());
