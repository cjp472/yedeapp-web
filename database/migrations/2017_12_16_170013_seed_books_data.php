<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedBooksData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $books = [
            [
                'title' => '我的第一本书',
                'slug' => 'my-first-book',
                'brief' => '<p>本书将教你如何使用 Laravel 一步一步构建一个类似新浪微博的应用，让你从实际开发中体会到 Laravel 开发的敏捷、愉悦与轻松。通过阅读本教程，你将学到如 HTML、CSS、JavaScript、PHP 和 Laravel 等 Web 开发相关的基础知识。本书还会对这些基础知识点进行延伸扩展，为你讲解一些在 Web 开发中更为专业、实用的技能，如 Git 工作流、Gulp 前端工作流、Bootstrap 框架基本使用等。这些知识将为你未来的编程开发奠定下坚实的基础。使你不论是在做自己的个人项目，或是构建一个伟大的商业产品时，都能得心应手。</p>',
                'preface' => '<p>本书将教你如何使用 Laravel 一步一步构建一个类似新浪微博的应用，让你从实际开发中体会到 Laravel 开发的敏捷、愉悦与轻松。通过阅读本教程，你将学到如 HTML、CSS、JavaScript、PHP 和 Laravel 等 Web 开发相关的基础知识。本书还会对这些基础知识点进行延伸扩展，为你讲解一些在 Web 开发中更为专业、实用的技能，如 Git 工作流、Gulp 前端工作流、Bootstrap 框架基本使用等。这些知识将为你未来的编程开发奠定下坚实的基础。使你不论是在做自己的个人项目，或是构建一个伟大的商业产品时，都能得心应手。</p>',
                'cover' => 'https://fsdhub.com/uploads/images/201709/18/1/nvXAaDu1iw.png',
                'price' => '39.00',
            ],
            [
                'title' => '我的第二本书',
                'slug' => 'my-second-book',
                'brief' => '<p>这是第二本了罗，本书将教你如何使用 Laravel 一步一步构建一个类似新浪微博的应用，让你从实际开发中体会到 Laravel 开发的敏捷、愉悦与轻松。通过阅读本教程，你将学到如 HTML、CSS、JavaScript、PHP 和 Laravel 等 Web 开发相关的基础知识。本书还会对这些基础知识点进行延伸扩展，为你讲解一些在 Web 开发中更为专业、实用的技能，如 Git 工作流、Gulp 前端工作流、Bootstrap 框架基本使用等。这些知识将为你未来的编程开发奠定下坚实的基础。使你不论是在做自己的个人项目，或是构建一个伟大的商业产品时，都能得心应手。</p>',
                'preface' => '<p>第二本的preface，好书好书！本书将教你如何使用 Laravel 一步一步构建一个类似新浪微博的应用，让你从实际开发中体会到 Laravel 开发的敏捷、愉悦与轻松。通过阅读本教程，你将学到如 HTML、CSS、JavaScript、PHP 和 Laravel 等 Web 开发相关的基础知识。本书还会对这些基础知识点进行延伸扩展，为你讲解一些在 Web 开发中更为专业、实用的技能，如 Git 工作流、Gulp 前端工作流、Bootstrap 框架基本使用等。这些知识将为你未来的编程开发奠定下坚实的基础。使你不论是在做自己的个人项目，或是构建一个伟大的商业产品时，都能得心应手。</p><p>本书还会对这些基础知识点进行延伸扩展，为你讲解一些在 Web 开发中更为专业、实用的技能，如 Git 工作流、Gulp 前端工作流、Bootstrap 框架基本使用等。这些知识将为你未来的编程开发奠定下坚实的基础。使你不论是在做自己的个人项目，或是构建一个伟大的商业产品时，都能得心应手。</p>',
                'cover' => 'https://fsdhub.com/uploads/images/201709/18/1/nvXAaDu1iw.png',
                'price' => '69.00',
            ]
        ];

        DB::table('books')->insert($books);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('books')->truncate();
    }
}
