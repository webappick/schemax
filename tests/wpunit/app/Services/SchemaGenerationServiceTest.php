<?php
namespace app\Services;

use lucatume\WPBrowser\TestCase\WPTestCase;
use Schemax\App\Mapping\MappingManager;
use Schemax\App\Mapping\ProductMapping;
use Schemax\App\Services\SchemaGenerationService;
use WP_Post;

class SchemaGenerationServiceTest extends WPTestCase
{
    /**
     * @var \WpunitTester
     */
    protected $tester;

    public function setUp() :void
    {
        // Before...
        parent::setUp();

        // Your set up methods here.
    }

    public function tearDown() :void
    {
        // Your tear down methods here.

        // Then...
        parent::tearDown();
    }

    // Tests
    public function test_factory() :void
    {
        $post = $this->factory()->post->create_and_get();

		// Initialize the MappingManager
		$mappingManager = new MappingManager();

		// Register the product mapping
		$productMapping = new ProductMapping();
		$mappingManager->registerMapping('Product', $productMapping);
		$service= new SchemaGenerationService($mappingManager);
		$schema = $service->generateSchema($post->ID);
		codecept_debug($schema->toArray());

        $this->assertInstanceOf(WP_Post::class, $post);
    }
}
