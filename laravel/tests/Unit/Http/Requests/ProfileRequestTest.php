<?php

namespace Tests\Unit\Http\Requests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @see \App\Http\Requests\ProfileRequest
 */
class ProfileRequestTest extends TestCase
{
    /** @var \App\Http\Requests\ProfileRequest */
    private $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = new \App\Http\Requests\ProfileRequest();
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
            'name' => [
                'required',
                'min:3',
            ],
            'email' => [
                'required',
                'email',
            ],
            'pilot_name' => [
                'required',
            ],
            'country' => [
                'required',
            ],
        ], $actual);
    }

    // test cases...
}
