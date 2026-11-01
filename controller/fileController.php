<?php
require_once __DIR__ . '/../model/sehatin.php';

class FileController
{
    private Sehatin $sehatin;

    public function __construct() { $this->sehatin = new Sehatin(); }
    public function index(): void { $this->show(); }
    public function show(): void { $this->Procces(); }

    public function Procces(): void
    {
        $profile = $this->sehatin->getProfile();
        $programs = $this->sehatin->getPrograms();
        $programError = $this->sehatin->getProgramError();
        require __DIR__ . '/../view/sehatin-page.php';
    }
}
