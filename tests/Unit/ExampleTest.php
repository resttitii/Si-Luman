<?php
//fix
//Pengujian semacam ini sering digunakan sebagai langkah awal untuk memastikan bahwa lingkungan pengujian berfungsi dengan baik sebelum melakukan pengujian yang lebih kompleks pada kode aplikasi

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     * Dalam metode ini, pengujian dilakukan menggunakan metode assertTrue() yang disediakan oleh PHPUnit. 
     * Metode ini memeriksa apakah argumen yang diberikan adalah true. 
     * Jika argumen tersebut true, maka pengujian dianggap berhasil. 
     * Dalam kasus ini, karena argumennya adalah true, pengujian akan berhasil
     */
    public function test_that_true_is_true(): void
    {
        $this->assertTrue(true);
    }
}
