<?php

namespace Tests\Unit\Http\Requests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @see \App\Http\Requests\PasswordRequest
 */
class PasswordRequestTest extends TestCase
{
    /** @var \App\Http\Requests\PasswordRequest */
    private $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = new \App\Http\Requests\PasswordRequest();
    }

    /**
     * @test
     */
    public function authorize()
    {
        $actual = $this->subject->authorize();

        $this->assertTrue($actual);
    }

    /**
     * @test
     */
    public function rules()
    {
        $actual = $this->subject->rules();

        $this->assertValidationRules([
            'old_password' => [
                'required',
            ],
            'password' => [
                'required',
                'min:6',
                'confirmed',
                'different:old_password',
            ],
            'password_confirmation' => [
                'required',
                'min:6',
            ],
        ], $actual);
    }

    /**
     * @test
     */
    public function attributes()
    {
        $actual = $this->subject->attributes();

        $this->assertEquals([], $actual);
    }

    // test cases...
}
