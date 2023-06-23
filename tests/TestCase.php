<?php
//fix
//dasar untuk pengujian dalam aplikasi Laravel
namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication; //membuat aplikasi Laravel yang baru dalam konteks pengujian
}
