<?php

namespace CSBill\PaymentBundle\Entity;

use CSBill\ClientBundle\Entity\Client;
use CSBill\InvoiceBundle\Entity\Invoice;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use APY\DataGridBundle\Grid\Mapping as Grid;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="payments")
 * @ORM\Entity(repositoryClass="CSBill\PaymentBundle\Repository\PaymentRepository")
 * @Gedmo\Loggable()
 * @Gedmo\SoftDeleteable(fieldName="deleted")
 */
class Payment
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * @var integer $id
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="CSBill\InvoiceBundle\Entity\Invoice", inversedBy="payments")
     *
     * @var Invoice
     */
    private $invoice;

    /**
     * @ORM\ManyToOne(targetEntity="CSBill\ClientBundle\Entity\Client", inversedBy="payments")
     *
     * @var Client
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity="CSBill\PaymentBundle\Entity\PaymentMethod", inversedBy="payments")
     *
     * @var PaymentMethod
     */
    private $method;

    /**
     * @var Status $status
     *
     * @ORM\ManyToOne(targetEntity="Status", inversedBy="payments")
     * @Grid\Column(name="status", field="status.name", title="status", filter="select", selectFrom="source")
     * @Grid\Column(field="status.label", visible=false)
     */
    private $status;

    /**
     * @ORM\Column(name="amount", type="float")
     */
    private $amount;

    /**
     * @ORM\Column(name="currency", type="string", length=24)
     */
    private $currency;

    /**
     * @ORM\Column(name="message", type="text", nullable=true)
     */
    private $message;

    /**
     * @var PaymentDetails
     *
     * @ORM\OneToOne(targetEntity="PaymentDetails", inversedBy="payment", cascade={"persist"}, fetch="EAGER")
     */
    private $details;

    /**
     * @var \DateTIme $created
     *
     * @ORM\Column(name="created", type="datetime")
     * @Gedmo\Timestampable(on="create")
     * @Assert\DateTime
     */
    private $created;

    /**
     * @var \DateTime $updated
     *
     * @ORM\Column(name="updated", type="datetime")
     * @Gedmo\Timestampable(on="update")
     * @Assert\DateTime
     */
    private $updated;

    /**
     * @var \DateTime $completed
     *
     * @ORM\Column(name="completed", type="datetime")
     * @Assert\DateTime
     */
    private $completed;

    /**
     * @var \DateTime $deleted
     *
     * @ORM\Column(name="deleted", type="datetime", nullable=true)
     * @Assert\DateTime
     */
    private $deleted;

    public function __construct()
    {
        $this->details = new PaymentDetails();
    }

    /**
     * Get the id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Invoice
     */
    public function getInvoice()
    {
        return $this->invoice;
    }

    /**
     * @param Invoice $invoice
     *
     * @return Payment
     */
    public function setInvoice(Invoice $invoice)
    {
        $this->invoice = $invoice;

        return $this;
    }

    /**
     * @return PaymentMethod
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param PaymentMethod $method
     *
     * @return Payment
     */
    public function setMethod(PaymentMethod $method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Set status
     *
     * @param Status $status
     *
     * @return Payment
     */
    public function setStatus(Status $status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return Status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set details
     *
     * @param PaymentDetails $details
     *
     * @return Payment
     */
    public function setDetails(PaymentDetails $details)
    {
        $this->details = $details;

        return $this;
    }

    /**
     * Get details
     *
     * @return PaymentDetails
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * Set currency
     *
     * @param float $currency
     *
     * @return Payment
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return float
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set amount
     *
     * @param float $amount
     *
     * @return Payment
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Payment
     */
    public function setCreated(\DateTime $created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Payment
     */
    public function setUpdated(\DateTime $updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set deleted
     *
     * @param \DateTime $deleted
     *
     * @return Payment
     */
    public function setDeleted(\DateTime $deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * @param string $message
     *
     * @return Payment
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return \DateTime
     */
    public function getCompleted()
    {
        return $this->completed;
    }

    /**
     * @param \DateTime $completed
     *
     * @return Payment
     */
    public function setCompleted(\DateTIme $completed)
    {
        $this->completed = $completed;

        return $this;
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param Client $client
     *
     * @return Payment
     */
    public function setClient(Client $client)
    {
        $this->client = $client;

        return $this;
    }
}