<?php
/**
 * 
 * @usage ./vendor/bin/phpunit ./tests/Unit/Model/UserTest.php
 * 
 * @author      Alan Cortes
 * @version     1.0.0
 * 
 */

namespace Tests\Unit;

use App\Models\Stat;
use App\Models\StatCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    private $testObject = null;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        $this->setUpTheTestEnvironment();
        $this->testObject = User::factory()->create();
    }

    public function testStats()
    {
        /**
         * The following are not actually constants, but they will be treated as such
         * 
         * Adjust the level of testing!
         */
        $NUM_CATEGORIES = 5;
        $NUM_STATS_PER_CATEGORY = 5;

        // Delete any existing data for the test (just so we don't accidentally get it)
        StatCategory::query()->delete();
        Stat::query()->delete();

        $stats = [];
        for ($i = 0; $i < $NUM_CATEGORIES; $i++) {
            $statsCategory = StatCategory::factory()->create();

            for ($j = 0; $j < $NUM_STATS_PER_CATEGORY; $j++) {
                $stats[] = Stat::factory()->create([
                    "fk_stats_category" => $statsCategory->id,
                    "fk_user_id" => $this->testObject->id,
                ])->toArray();
            }
        }
        
        $result = $this->testObject->stats()->get()->toArray();

        $this->assertEquals($stats, $result, "Check testStats - The user relationship with their stats");
    }
}
