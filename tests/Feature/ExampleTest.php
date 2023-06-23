<?php
//fix
//Pengujian semacam ini berguna untuk memastikan bahwa aplikasi mengembalikan respons yang diharapkan dan dapat mencapai rute yang ditentukan

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        //Metode ini melakukan permintaan HTTP GET ke URL /. Respons dari permintaan tersebut disimpan dalam variabel $response
        $response = $this->get('/');

        //igunakan untuk memeriksa apakah respons memiliki kode status HTTP 200. Jika respons memiliki kode status 200, maka pengujian dianggap berhasil
        $response->assertStatus(200);
    }
}
