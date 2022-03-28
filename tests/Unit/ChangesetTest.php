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
        $changes = [
            'name' => "Test Customer",
            'email' => "test@gmail.com"
        ];

        $changeset = new Changeset((object) [], $changes, Changeset::INSERT);
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

    /** @test **/
    public function should_create_validations_for_class()
    {

        $customer = new Customer();
        $changeset = $customer->changeset([
            'name' => "Test Customer",
            'email' => 'wrondemail',
            'document' => 'invalid_document'
        ], Changeset::INSERT);

        $customerChangeset = $customer->validate($changeset);

        var_dump($customerChangeset);
        $this->assertFalse($customerChangeset->isValid);
        $this->assertNotEmpty($customerChangeset->errors);
    }
}
