<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BlogPostController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\TemplateController;
use App\Http\Controllers\Api\TeamMemberController;
use App\Http\Controllers\Api\TestimonialController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\FaqController;
use App\Http\Controllers\Api\ContactMessageController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\FooterController;
use App\Http\Controllers\Api\HeroSectionController;
use App\Http\Controllers\Api\CtaController;
use App\Http\Controllers\Api\ContactInfoController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\LicenseController;
use App\Http\Controllers\Api\MediaController;
use App\Http\Controllers\Api\AiChatController;

// Hero Section
Route::get('/hero', [HeroSectionController::class, 'index']);

// Blog Posts
Route::get('/blog-posts', [BlogPostController::class, 'index']);
Route::get('/blog-posts/{slug}', [BlogPostController::class, 'show']);

// Media
Route::get('/media', [MediaController::class, 'index']);
Route::get('/media/{slug}', [MediaController::class, 'show']);

// Projects
Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/featured', [ProjectController::class, 'featured']);
Route::get('/projects/{slug}', [ProjectController::class, 'show']);

// Services
Route::get('/services', [ServiceController::class, 'index']);
Route::get('/services/{slug}', [ServiceController::class, 'show']);

// Templates
Route::get('/templates', [TemplateController::class, 'index']);
Route::get('/templates/{slug}', [TemplateController::class, 'show']);

// Team Members
Route::get('/team', [TeamMemberController::class, 'index']);

// Testimonials
Route::get('/testimonials', [TestimonialController::class, 'index']);

// Clients
Route::get('/clients', [ClientController::class, 'index']);

// FAQs
Route::get('/faqs', [FaqController::class, 'index']);

// CTA
Route::get('/cta', [CtaController::class, 'index']);

// Contact Info
Route::get('/contact-info', [ContactInfoController::class, 'index']);

// Contact Messages
Route::post('/contact', [ContactMessageController::class, 'store']);

// Settings
Route::get('/settings', [SettingController::class, 'index']);
Route::get('/settings/{key}', [SettingController::class, 'show']);

// Footer
Route::get('/footer', [FooterController::class, 'index']);

// Pages
Route::get('/pages', [PageController::class, 'index']);
Route::get('/pages/{slug}', [PageController::class, 'show']);

// License
Route::get('/license', [LicenseController::class, 'index']);

// AI Chat
Route::post('/ai/chat', [AiChatController::class, 'chat']);
