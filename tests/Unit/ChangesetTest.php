<?php
namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Phecto\Changeset;
use Tests\Fixtures\Customer;

final class ChangesetTest extends TestCase
{

    /** @test **/
    public function should_create_a_changeset()
    {
        $customer = new Customer(name: "", email: "");
        $changes = [
            'name' => "Test Customer",
            'email' => "test@gmail.com"
        ];

        $changeset = new Changeset($customer, $changes, Changeset::INSERT);
        $this->assertEquals($changeset->changes, $changes);
    }

    /** @test **/
    public function should_create_a_changeset_with_required()
    {
        $changes = [
            'name' => "Test Customer",
        ];

        $changeset = (new Changeset((object) [], $changes, Changeset::INSERT))
            ->setRequired(['email']);

        $this->assertFalse($changeset->isValid);
        $this->assertNotEmpty($changeset->errors);
    }
}
