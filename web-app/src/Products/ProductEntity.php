<?


  namespace Src\Products;

  use Doctrine\ORM\Mapping\Column;
  use Doctrine\ORM\Mapping\Id;

  /**
   * @Entity @Table(name="products")
   **/
  class ProductEntity
  {
    /**
     * @Id @Column(type="integer") @GeneratedValue
     */
    private $id;

    /**
     * @Column(type="string")
     * @var string|null
     */
    private $name;


    public function getId() : int
    {
      return $this->id;
    }


    public function getName() : ?string
    {
      return $this->name;
    }


    public function setName(string $name) : void
    {
      $this->name = $name;
    }
  }