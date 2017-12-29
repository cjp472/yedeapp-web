<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedCoursesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $book1_chapters_array = [
            [
                'id' => 1,
                'name' => '第1章 如何入门一门新知识',
                'topics' => [1,2,3],
                'order' => 1
            ],[
                'id' => 2,
                'name' => '第2章 编程技术到底难在哪里？',
                'topics' => [4,5,6],
                'order' => 2
            ]
        ];

        $book2_chapters_array = [
            [
                'id' => 1,
                'name' => '第1章 探索一片全新的领域',
                'topics' => [7,8,9],
                'order' => 1
            ],[
                'id' => 2,
                'name' => '第2章 喜爱的、能做的和在做的',
                'topics' => [10,11,12],
                'order' => 2
            ]
        ];

        $courses = [
            [
                'name' => '我的第一个课程',
                'slug' => 'my-first-course',
                'intro' => '<p>本书将教你如何使用 Laravel 一步一步构建一个类似新浪微博的应用，让你从实际开发中体会到 Laravel 开发的敏捷、愉悦与轻松。通过阅读本教程，你将学到如 HTML、CSS、JavaScript、PHP 和 Laravel 等 Web 开发相关的基础知识。本书还会对这些基础知识点进行延伸扩展，为你讲解一些在 Web 开发中更为专业、实用的技能，如 Git 工作流、Gulp 前端工作流、Bootstrap 框架基本使用等。这些知识将为你未来的编程开发奠定下坚实的基础。使你不论是在做自己的个人项目，或是构建一个伟大的商业产品时，都能得心应手。</p>',
                'introduction' => '<p>本书将教你如何使用 Laravel 一步一步构建一个类似新浪微博的应用，让你从实际开发中体会到 Laravel 开发的敏捷、愉悦与轻松。通过阅读本教程，你将学到如 HTML、CSS、JavaScript、PHP 和 Laravel 等 Web 开发相关的基础知识。本书还会对这些基础知识点进行延伸扩展，为你讲解一些在 Web 开发中更为专业、实用的技能，如 Git 工作流、Gulp 前端工作流、Bootstrap 框架基本使用等。这些知识将为你未来的编程开发奠定下坚实的基础。使你不论是在做自己的个人项目，或是构建一个伟大的商业产品时，都能得心应手。</p>',
                'cover' => 'https://fsdhub.com/uploads/images/201709/18/1/nvXAaDu1iw.png',
                'price' => '39.00',
                'user_id' => 1,
                'chapters' => json_encode($book1_chapters_array),
            ],
            [
                'name' => '我的第二个课程',
                'slug' => 'my-second-course',
                'intro' => '<p>这是第二本了罗，本书将教你如何使用 Laravel 一步一步构建一个类似新浪微博的应用，让你从实际开发中体会到 Laravel 开发的敏捷、愉悦与轻松。通过阅读本教程，你将学到如 HTML、CSS、JavaScript、PHP 和 Laravel 等 Web 开发相关的基础知识。本书还会对这些基础知识点进行延伸扩展，为你讲解一些在 Web 开发中更为专业、实用的技能，如 Git 工作流、Gulp 前端工作流、Bootstrap 框架基本使用等。这些知识将为你未来的编程开发奠定下坚实的基础。使你不论是在做自己的个人项目，或是构建一个伟大的商业产品时，都能得心应手。</p>',
                'introduction' => '<p>Laravel 一步一步构建一个类似新浪微博的应用，让你从实际开发中体会到 Laravel 开发的敏捷、愉悦与轻松。通过阅读本教程，你将学到如 HTML、CSS、JavaScript、PHP 和 Laravel 等 Web 开发相关的基础知识。本书还会对这些基础知识点进行延伸扩展，为你讲解一些在 Web 开发中更为专业、实用的技能，如 Git 工作流、Gulp 前端工作流、Bootstrap 框架基本使用等。这些知识将为你未来的编程开发奠定下坚实的基础。使你不论是在做自己的个人项目，或是构建一个伟大的商业产品时，都能得心应手。</p><p>本书还会对这些基础知识点进行延伸扩展，为你讲解一些在 Web 开发中更为专业、实用的技能，如 Git 工作流、Gulp 前端工作流、Bootstrap 框架基本使用等。这些知识将为你未来的编程开发奠定下坚实的基础。使你不论是在做自己的个人项目，或是构建一个伟大的商业产品时，都能得心应手。</p>',
                'cover' => 'https://fsdhub.com/uploads/images/201709/18/1/nvXAaDu1iw.png',
                'price' => '69.00',
                'user_id' => 1,
                'chapters' => json_encode($book2_chapters_array),
            ]
        ];

        DB::table('courses')->insert($courses);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('courses')->truncate();
    }
}
