<?php

namespace Ixopay\Client\Dispute;

class DisputeUploadEvidenceData extends AbstractDisputeData
{
    /**
     * @var string
     */
    private $filePathWithFileName = '';
    /**
     * @var string
     */
    private $postName = '';

    public function __construct($uuid, $filePathWithFileName)
    {
        parent::__construct($uuid);
        $this->filePathWithFileName = $filePathWithFileName;
    }

    /**
     * @param $filePath
     * @return $this
     */
    public function setFilePathWithFileName($filePathWithFileName)
    {
        $this->filePathWithFileName = $filePathWithFileName;
        return $this;
    }

    /**
     * @return string
     */
    public function getFilePathWithFileName()
    {
        return $this->filePathWithFileName;
    }

    /**
     * @param string $postName
     * @return DisputeUploadEvidenceData
     */
    public function setPostName($postName)
    {
        $this->postName = $postName;
        return $this;
    }

    /**
     * @return string
     */
    public function getPostName()
    {
        return $this->postName;
    }
}
