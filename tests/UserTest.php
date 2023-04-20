<?php
use App\User;
use App\Company;
use App\Department;
use App\Type;
use App\UserMeta;
use App\UsersBlacklist;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function testCreateOrUpdateUser()
    {
        // Generate Fake Data using faker
        $role = $this->faker->word;
        $name = $this->faker->name;
        $company_id = $this->faker->randomNumber();
        $department_id = $this->faker->randomNumber();
        $email = $this->faker->email;
        $dob_or_orgid = $this->faker->date;
        $phone = $this->faker->phoneNumber;
        $mobile = $this->faker->phoneNumber;
        $password = $this->faker->password;
        $consumer_type = $this->faker->word;
        $customer_type = $this->faker->word;
        $username = $this->faker->word;
        $post_code = $this->faker->postcode;
        $address = $this->faker->address;
        $city = $this->faker->city;
        $town = $this->faker->word;
        $country = $this->faker->country;
        $reference = $this->faker->boolean;
        $additional_info = $this->faker->sentence;
        $cost_place = $this->faker->word;
        $fee = $this->faker->word;
        $time_to_charge = $this->faker->word;
        $time_to_pay = $this->faker->word;
        $charge_ob = $this->faker->word;
        $customer_id = $this->faker->word;
        $charge_km = $this->faker->word;
        $maximum_km = $this->faker->word;
        $translator_ex = [1, 2, 3];
        $translator_type = $this->faker->word;
        $worked_for = $this->faker->word;
        $organization_number = $this->faker->word;
        $gender = $this->faker->word;
        $translator_level = $this->faker->word;

        $data = [
            'role' => $role,
            'name' => $name,
            'company_id' => $company_id,
            'department_id' => $department_id,
            'email' => $email,
            'dob_or_orgid' => $dob_or_orgid,
            'phone' => $phone,
            'mobile' => $mobile,
            'password' => $password,
            'consumer_type' => $consumer_type,
            'customer_type' => $customer_type,
            'username' => $username,
            'post_code' => $post_code,
            'address' => $address,
            'city' => $city,
            'town' => $town,
            'country' => $country,
            'reference' => $reference,
            'additional_info' => $additional_info,
            'cost_place' => $cost_place,
            'fee' => $fee,
            'time_to_charge' => $time_to_charge,
            'time_to_pay' => $time_to_pay,
            'charge_ob' => $charge_ob,
            'customer_id' => $customer_id,
            'charge_km' => $charge_km,
            'maximum_km' => $maximum_km,
            'translator_ex' => $translator_ex,
            'translator_type' => $translator_type,
            'worked_for' => $worked_for,
            'organization_number' => $organization_number,
            'gender' => $gender,
            'translator_level' => $translator_level
        ];

        // Create a new user
        $response = $this->postJson('/api/user', $data);

        $response->assertStatus(201);

        // Update the user
        $user = json_decode($response->getContent())->data;
        $data['name'] = 'Jane Doe';
        $response = $this->putJson('/api/user/' . $user->id, $data);

        $response->assertStatus(200);

        // Check that the user was updated correctly
        $updatedUser = json_decode($response->getContent())->data;
        $this->assertEquals($data['name'], $updatedUser->name);
        $this->assertEquals($data['customer_type'], $updatedUser->meta->customer_type);
        $this->assertEquals($data['translator_type'], $updatedUser->meta->translator_type);
    }
}
