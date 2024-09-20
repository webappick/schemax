<?php
namespace app\Services;

use lucatume\WPBrowser\TestCase\WPTestCase;
use Schemax\App\Data\DataFactory;
use Schemax\App\Mapping\MappingFactory;
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

	/**
	 * @throws \Exception
	 */
	public function test_factory() :void
    {
        $post = $this->factory()->post->create_and_get();

		$product = new \WC_Product_Simple();
		$product->set_name('Test Product');
		$product->set_description('Test Description');
		$product->set_sku('test-sku');
		$product->set_price(100);
		$product->set_stock_status('instock');
		$product->set_manage_stock(true);
		$product->set_stock_quantity(10);
		$product->set_status('publish');
		$product->save();

//		// Initialize the MappingManager
        $data = DataFactory::getData('Article', $post);
		$mapping = new MappingFactory('Article');
		$articleMapping = $mapping->getMapping();
		$service = new SchemaGenerationService();
		$schema = $service->generateSchema('Article', $post);

		codecept_debug( $schema->toArray() );

		$data = DataFactory::getData('Product', $product);
		$mapping = new MappingFactory('Product');
		$productMapping = $mapping->getMapping();
		$service = new SchemaGenerationService();
		$schema = $service->generateSchema('Product', $product);

		codecept_debug( $schema->toArray() );


////		codecept_debug( $data );
//
//		// Register the product mapping
//		$productMapping = new ProductMapping();
//		$mappingManager = new MappingManager();
//		$mappingManager->registerMapping('Product', $productMapping);
//		codecept_debug($mappingManager->getMapping('Product'));
//		$service= new SchemaGenerationService($mappingManager);
//		$schema = $service->generateSchema($post->ID);
//		codecept_debug($schema->toArray());

        $this->assertInstanceOf(WP_Post::class, $post);
    }
}
