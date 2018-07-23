<?php
/** @noinspection SpellCheckingInspection */
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera\JDF;

use RWC\Caldera\AbstractJDFComponent;
use RWC\Caldera\IJDFComponent;
use RWC\Caldera\Configurations;
use RWC\Caldera\JDF\PrintConfig\Action\ActionOption;
use RWC\Caldera\JDF\PrintConfig\Cartouche;
use RWC\Caldera\JDF\PrintConfig\Collate;
use RWC\Caldera\JDF\PrintConfig\ColorBar;
use RWC\Caldera\JDF\PrintConfig\CropMarks;
use RWC\Caldera\JDF\PrintConfig\CutFile;
use RWC\Caldera\JDF\PrintConfig\Image;
use RWC\Caldera\JDF\PrintConfig\InPage;
use RWC\Caldera\JDF\PrintConfig\Loading;
use RWC\Caldera\JDF\PrintConfig\LogoAnnotation;
use RWC\Caldera\JDF\PrintConfig\MarkSetup;
use RWC\Caldera\JDF\PrintConfig\NestingMode\NestingModeOption;
use RWC\Caldera\JDF\PrintConfig\Paper\PaperOption;
use RWC\Caldera\JDF\PrintConfig\PrintGab;
use RWC\Caldera\JDF\PrintConfig\PrintResolution;
use RWC\Caldera\JDF\PrintConfig\StepAndRepeat;

/**
 * Class PrintConfig
 * @package RWC\Caldera\JDF
 */
class PrintConfig extends AbstractJDFComponent
{
    /**
     * Print color mode name.
     *
     * @var string|null
     */
    protected $modeName;

    /**
     * Print resoltion name.
     *
     * @var PrintResolution
     */
    protected $printResolution;

    /**
     * Loading selector.
     *
     * @var Loading
     */
    protected $loading;

    /**
     * Printer medium selector.
     *
     * @var PaperOption
     */
    protected $paper;

    /**
     * Print quality selector. Value depends on the printer.
     *
     * @var string|null
     */
    protected $quality;

    /**
     * Action selector.
     *
     * @var ActionOption
     */
    protected $action;

    /**
     * Page template settings.
     *
     * @var PrintGab
     */
    protected $printGab;

    /**
     * Image settings.
     *
     * @var Image
     */
    protected $image;

    /**
     * InPage options.
     *
     * @var InPage
     */
    protected $inPage;

    /**
     * Nesting Mode
     *
     * @var NestingModeOption
     */
    protected $nestingMode;

    /**
     * Number of copies.
     *
     * @var int|null
     */
    protected $numberOfCopies;

    /**
     * Number of copies to nest in one page for Step * Repeat METHOD_CUSTOM.
     *
     * @var int|null
     */
    protected $nbCopiesStepAndRepeat;

    /**
     * Number of pages to print when nesting_mode = METHOD_CUSTOM.
     *
     * @var int|null
     */
    protected $nbPagesStepAndRepeat;

    /**
     * Toggles step and repeat mode that creates independent rows.
     *
     * @var bool|null
     */
    protected $nestRows;

    /**
     * Margin to apply between occurences of image in Step & Repeat.
     *
     * @var float|null
     */
    protected $nestingMargin;

    /**
     * Before 9.10: Prevents printing if the scale is not 100% After 9.10:
     * Prevents printinf if the scale is different from value specified by
     * <print_only_if_value>
     *
     * @var bool|null
     */
    protected $printOnlyIf100;

    /**
     * New in 9.10: Specifies the scale value the user wants to print with
     * (only if <print_only_if_100> is true)
     *
     * @var bool|null
     */
    protected $printOnlyIfValue;

    /**
     * Enables the Nest-O-Ba feature.
     *
     * @var null|bool
     */
    protected $enableNestOba;

    /**
     * UNDOCUMENTED. Nest-o-Ba configuration data
     *
     * @var string|null
     */
    protected $nbaFile;

    /**
     * Annotation settings.
     *
     * @var Cartouche
     */
    protected $cartouche;

    /**
     * Activates logo in annotation. New in 9.10
     *
     * @var LogoAnnotation|null
     */
    protected $logoAnnotation;

    /**
     * Mark configuration
     *
     * @var MarkSetup
     */
    protected $markSetup;

    /**
     * Activates cutting.
     *
     * @var bool|null
     */
    protected $enableCut;

    /**
     * UNDOCUMENTED. Cutting configuration data. (Obsolete from 9.20)
     *
     * @var CutFile|null
     */
    protected $cutFile;

    /**
     * Color management configuration. UNDOCUMENTED
     *
     * @var string|null
     */
    protected $colorManagement;

    /**
     * ColorBar options.
     *
     * @var ColorBar
     */
    protected $colorBar;

    /**
     * UNDOCUMENTED. Color corrections configuration data
     *
     * @var string|null
     */
    protected $colorCorrections;

    /**
     * UNDOCUMENTED. InkPerformer configuration data
     *
     * @var string|null
     */
    protected $inkOptimizer;

    /**
     * Collation settings.
     *
     * @var Collate
     */
    protected $collate;

    /**
     * New in 9.20. Specific parameters for cutting. Parameter description
     * available upon request.
     *
     * @var string|null
     */
    protected $cutParameters;

    /**
     * UNDOCUMENTED. Printer specific configuration data
     *
     * @var string|null
     */
    protected $specConfig;

    /**
     * Step & Repeat settings.
     *
     * @var StepAndRepeat
     */
    protected $stepAndRepeat;

    /**
     * Cropmarks settings.
     *
     * @var CropMarks
     */
    protected $cropMarks;

    /**
     * @var string
     */
    protected $inksetFile;

    /**
     * PrintConfig constructor.
     * @param null|string $modeName
     * @param null|PrintResolution $printResolution
     * @param null|Loading $loading
     * @param null|PaperOption $paper
     * @param null|string $quality
     * @param null|ActionOption $action
     * @param null|PrintGab $printGab
     * @param null|Image $image
     * @param null|InPage $inPage
     * @param null|NestingModeOption $nestingModeOption
     * @param int|null $numberOfCopies
     * @param int|null $nbCopiesStepAndRepeat
     * @param int|null $nbPagesStepAndRepeat
     * @param bool|null $nestRows
     * @param float|null $nestingMargin
     * @param bool|null $printOnlyIf100
     * @param bool|null $printOnlyIfValue
     * @param bool|null $enableNestOba
     * @param null|string $nbaFile
     * @param null|Cartouche $cartouche
     * @param null|LogoAnnotation $logoAnnotation
     * @param null|MarkSetup $markSetup
     * @param bool|null $enableCut
     * @param null|CutFile $cutFile
     * @param null|string $colorManagement
     * @param null|ColorBar $colorBar
     * @param null|string $colorCorrection
     * @param null|string $inkOptimizer
     * @param null|Collate $collate
     * @param null|string $cutParameters
     * @param null|string $specConfig
     * @param null|StepAndRepeat $stepAndRepeat
     * @param null|CropMarks $cropMarks
     * @param null|string $inksetFile
     */
    public function __construct(
        ?string $modeName = null,
        ?PrintResolution $printResolution = null,
        ?Loading $loading = null,
        ?PaperOption $paper = null,
        ?string $quality = null,
        ?ActionOption $action = null,
        ?PrintGab $printGab = null,
        ?Image $image = null,
        ?InPage $inPage = null,
        ?NestingModeOption $nestingModeOption = null,
        ?int $numberOfCopies = null,
        ?int $nbCopiesStepAndRepeat = null,
        ?int $nbPagesStepAndRepeat = null,
        ?bool $nestRows = null,
        ?float $nestingMargin = null,
        ?bool $printOnlyIf100 = null,
        ?bool $printOnlyIfValue = null,
        ?bool $enableNestOba = null,
        ?string $nbaFile = null,
        ?Cartouche $cartouche = null,
        ?LogoAnnotation $logoAnnotation = null,
        ?MarkSetup $markSetup = null,
        ?bool $enableCut = null,
        ?CutFile $cutFile = null,
        ?string $colorManagement = null,
        ?ColorBar $colorBar = null,
        ?string $colorCorrection = null,
        ?string $inkOptimizer = null,
        ?Collate $collate = null,
        ?string $cutParameters = null,
        ?string $specConfig = null,
        ?StepAndRepeat $stepAndRepeat = null,
        ?CropMarks $cropMarks = null,
        ?string $inksetFile = null
    ) {
        $this->setInksetFile($inksetFile);
        $this->setModeName($modeName);
        $this->setPrintResolution($printResolution);
        $this->setLoading($loading);
        $this->setPaper($paper);
        $this->setQuality($quality);
        $this->setAction($action);
        $this->setPrintGab($printGab);
        $this->setImage($image);
        $this->setInPage($inPage);
        $this->setNestingMode($nestingModeOption);
        $this->setNumberOfCopies($numberOfCopies);
        $this->setNumberOfCopiesStepAndRepeat($nbCopiesStepAndRepeat);
        $this->setNumberOfPagesStepAndRepeat($nbPagesStepAndRepeat);
        $this->setNestRows($nestRows);
        $this->setNestingMargin($nestingMargin);
        $this->setPrintOnlyIf100($printOnlyIf100);
        $this->setPrintOnlyIfValue($printOnlyIfValue);
        $this->setEnableNestOba($enableNestOba);
        $this->setNbaFile($nbaFile);
        $this->setCartouche($cartouche);
        $this->setLogoAnnotation($logoAnnotation);
        $this->setMarkSetup($markSetup);
        $this->setEnableCut($enableCut);
        $this->setCutFile($cutFile);
        $this->setColorManagement($colorManagement);
        $this->setColorBar($colorBar);
        $this->setColorCorrections($colorCorrection);
        $this->setInkOptimizer($inkOptimizer);
        $this->setCollate($collate);
        $this->setPrinterSpecificConfiguration($specConfig);
        $this->setStepAndRepeat($stepAndRepeat);
        $this->setCropMarks($cropMarks);
        $this->setCutParameters($cutParameters);
    }

    /**
     * @param null|string $inksetFile
     */
    public function setInksetFile(?string $inksetFile) : void
    {
        $this->inksetFile = $inksetFile;
    }

    /**
     * @return null|string
     */
    public function getInksetFile() : ?string
    {
        return $this->inksetFile;
    }

    /**
     * New in 9.20. Specific parameters for cutting. Parameter description
     * available upon request.
     *
     * @param null|string $cutParameters Specific parameters for cutting.
     */
    public function setCutParameters(?string $cutParameters) : void
    {
        $this->cutParameters = $cutParameters;
    }

    /**
     * New in 9.20. Specific parameters for cutting. Parameter description
     * available upon request.
     *
     * @return null|string Specific parameters for cutting.
     */
    public function getCutParameters() : ?string
    {
        return $this->cutParameters;
    }

    /**
     * Page template settings.
     *
     * @param null|PrintGab $printGab Page template settings.
     */
    public function setPrintGab(?PrintGab $printGab = null) : void
    {
        $this->printGab = $printGab;
    }

    /**
     * Page template settings.
     *
     * @return null|PrintGab Page template settings.
     */
    public function getPrintGab() : ?PrintGab
    {
        return $this->printGab;
    }

    /**
     * Step and Repeat settings.
     *
     * @param null|StepAndRepeat $stepAndRepeat Step and Repeat settings.
     */
    public function setStepAndRepeat(?StepAndRepeat $stepAndRepeat) : void
    {
        $this->stepAndRepeat = $stepAndRepeat;
    }

    /**
     * Step and Repeat settings.
     *
     * @return null|StepAndRepeat Step and Repeat settings.
     */
    public function getStepAndRepeat() : ?StepAndRepeat
    {
        return $this->stepAndRepeat;
    }

    /**
     * UNDOCUMENTED. Printer specific configuration data
     *
     * @param null|string $specConfig UNDOCUMENTED. Printer specific configuration data
     */
    public function setPrinterSpecificConfiguration(?string $specConfig = null) : void
    {
        $this->specConfig = $specConfig;
    }

    /**
     * UNDOCUMENTED. Printer specific configuration data
     *
     * @return null|string UNDOCUMENTED. Printer specific configuration data
     */
    public function getPrinterSpecificConfiguration() : ?string
    {
        return $this->specConfig;
    }
    /**
     * New in 9.20. Specific parameters for cutting. Parameter description
     * available upon request.
     *
     * @param null|string $cutParameters Specific parameters for cutting.
     */
    public function setCut(?string $cutParameters = null) : void
    {
        $this->cutParameters = $cutParameters;
    }

    /**
     * New in 9.20. Specific parameters for cutting. Parameter description
     * available upon request.
     *
     * @return null|string Specific parameters for cutting.
     */
    public function getCut() : ?string
    {
        return $this->cutParameters;
    }

    /**
     * Sets collation settings.
     *
     * @param null|Collate $collate Collation settings.
     */
    public function setCollate(?Collate $collate = null) : void
    {
        $this->collate = $collate;
    }

    /**
     * Return collation settings.
     *
     * @return null|Collate Return collation settings.
     */
    public function getCollate() : ?Collate
    {
        return $this->collate;
    }

    /**
     * UNDOCUMENTED. InkPerformer configuration data
     *
     * @param null|string $inkOptimizer UNDOCUMENTED. InkPerformer configuration data
     */
    public function setInkOptimizer(?string $inkOptimizer) : void
    {
        $this->inkOptimizer = $inkOptimizer;
    }

    /**
     * UNDOCUMENTED. InkPerformer configuration data
     *
     * @return null|string UNDOCUMENTED. InkPerformer configuration data
     */
    public function getInkOptimizer() : ?string
    {
        return $this->inkOptimizer;
    }

    /**
     * UNDOCUMENTED. Color corrections configuration data
     *
     * @param null|string $colorCorrections UNDOCUMENTED. Color corrections configuration data
     */
    public function setColorCorrections(?string $colorCorrections = null) : void
    {
        $this->colorCorrections = $colorCorrections;
    }

    /**
     * UNDOCUMENTED. Color corrections configuration data
     *
     * @return null|string UNDOCUMENTED. Color corrections configuration data
     */
    public function getColorCorrections() : ?string
    {
        return $this->colorCorrections;
    }

    /**
     * Sets ColorBar options.
     *
     * @param null|ColorBar $colorBar Sets ColorBar options.
     */
    public function setColorBar(?ColorBar $colorBar = null) : void
    {
        $this->colorBar = $colorBar;
    }

    /**
     * Returns ColorBar options.
     *
     * @return null|ColorBar Returns ColorBar options.
     */
    public function getColorBar() : ?ColorBar
    {
        return $this->colorBar;
    }

    /**
     * Color management configuration. UNDOCUMENTED
     *
     * @param null|string $colorManagement Color management configuration. UNDOCUMENTED
     */
    public function setColorManagement(?string $colorManagement = null) : void
    {
        $this->colorManagement = $colorManagement;
    }

    /**
     * Color management configuration. UNDOCUMENTED
     *
     * @return null|string Color management configuration. UNDOCUMENTED
     */
    public function getColorManagement() : ?string
    {
        return $this->colorManagement;
    }
    /**
     * UNDOCUMENTED. Cutting configuration data. (Obsolete from 9.20)
     *
     * @param null|CutFile $cutFile UNDOCUMENTED. Cutting configuration data. (Obsolete from 9.20)
     */
    public function setCutFile(?CutFile $cutFile = null) : void
    {
        $this->cutFile = $cutFile;
    }

    /**
     * UNDOCUMENTED. Cutting configuration data. (Obsolete from 9.20)
     *
     * @return null|CutFile UNDOCUMENTED. Cutting configuration data. (Obsolete from 9.20)
     */
    public function getCutFile() : ?CutFile
    {
        return $this->cutFile;
    }

    /**
     * Activates cutting.
     *
     * @param bool|null $enableCut Activates cutting.
     */
    public function setEnableCut(?bool $enableCut = null) : void
    {
        $this->enableCut = $enableCut;
    }

    /**
     * Activates cutting.
     *
     * @return bool|null Activates cutting.
     */
    public function getEnableCut() : ?bool
    {
        return $this->enableCut;
    }

    /**
     * Mark color setup.
     *
     * @param MarkSetup|null $markSetup Mark color setup.
     */
    public function setMarkSetup(?MarkSetup $markSetup = null) : void
    {
        $this->markSetup = $markSetup;
    }

    /**
     * Mark color setup.
     *
     * @return MarkSetup|null Mark color setup.
     */
    public function getMarkSetup() : ?MarkSetup
    {
        return $this->markSetup;
    }
    /**
     * Activates logo in annotation. New in 9.10
     *
     * @param LogoAnnotation|null $logoAnnotation Activates logo in annotation. New in 9.10
     */
    public function setLogoAnnotation(?LogoAnnotation $logoAnnotation = null) : void
    {
        $this->logoAnnotation = $logoAnnotation;
    }

    /**
     * Activates logo in annotation. New in 9.10
     *
     * @return LogoAnnotation|null Activates logo in annotation. New in 9.10
     */
    public function getLogoAnnotation() : ?LogoAnnotation
    {
        return $this->logoAnnotation;
    }

    /**
     * Sets annotation settings ("Cartouche").
     *
     * @param Cartouche $cartouche Annotation settings ("Cartouche").
     */
    public function setCartouche(?Cartouche $cartouche = null)  : void
    {
        $this->cartouche = $cartouche;
    }

    /**
     * Returns annotation settings ("Cartouche").
     *
     * @return Cartouche Returns annotation settings ("Cartouche").
     */
    public function getCartouche() : Cartouche
    {
        return $this->cartouche;
    }

    /**
     * UNDOCUMENTED. Nest-o-Ba configuration data
     *
     * @param null|string $nbaFile UNDOCUMENTED. Nest-o-Ba configuration data
     */
    public function setNbaFile(?string $nbaFile = null) : void
    {
        $this->nbaFile = $nbaFile;
    }

    /**
     * UNDOCUMENTED. Nest-o-Ba configuration data
     *
     * @return null|string UNDOCUMENTED. Nest-o-Ba configuration data
     */
    public function getNbaFile() : ?string
    {
        return $this->nbaFile;
    }
    /**
     * Enables the Nest-O-Ba feature.
     *
     * @param bool|null $enableNestOba Enables the Nest-O-Ba feature.
     */
    public function setEnableNestOba(?bool $enableNestOba = null) : void
    {
        $this->enableNestOba = $enableNestOba;
    }

    /**
     * Enables the Nest-O-Ba feature.
     *
     * @return bool|null Enables the Nest-O-Ba feature.
     */
    public function getEnableNestOba() : ?bool
    {
        return $this->enableNestOba;
    }

    /**
     * Crop marks settings.
     *
     * @param CropMarks|null $cropMarks
     */
    public function setCropMarks(?CropMarks $cropMarks = null) : void
    {
        $this->cropMarks = $cropMarks;
    }

    /**
     * Crop marks settings.
     *
     * @return null|CropMarks
     */
    public function getCropMarks() : ?CropMarks
    {
        return $this->cropMarks;
    }

    /**
     * New in 9.10: Specifies the scale value the user wants to print with
     * (only if <print_only_if_100> is true)
     *
     * @param bool|null $printOnlyIfValue Specifies the scale value the user wants to print with
     */
    public function setPrintOnlyIfValue(?bool $printOnlyIfValue = null) : void
    {
        $this->printOnlyIfValue = $printOnlyIfValue;
    }

    /**
     * New in 9.10: Specifies the scale value the user wants to print with
     * (only if <print_only_if_100> is true)
     *
     * @return bool|null Specifies the scale value the user wants to print with
     */
    public function getPrintOnlyIfValue() : ?bool
    {
        return $this->printOnlyIfValue;
    }

    /**
     * Before 9.10: Prevents printing if the scale is not 100% After 9.10:
     * Prevents printinf if the scale is different from value specified by
     * <print_only_if_value>
     *
     * @param bool|null $printOnlyIf100 printinf if the scale is different from value specified by <print_only_if_value>
     */
    public function setPrintOnlyIf100(?bool $printOnlyIf100 = false) : void
    {
        $this->printOnlyIf100 = $printOnlyIf100;
    }

    /**
     * Before 9.10: Prevents printing if the scale is not 100% After 9.10:
     * Prevents printinf if the scale is different from value specified by
     * <print_only_if_value>
     *
     * @return bool|null printinf if the scale is different from value specified by <print_only_if_value>
     */
    public function getPrintOnlyI100() : ?bool
    {
        return $this->printOnlyIf100;
    }

    /**
     * Margin to apply between occurrences of image in Step&Repeat
     *
     * @param float|null $nestingMargin Margin to apply between occurrences of image in Step&Repeat
     */
    public function setNestingMargin(?float $nestingMargin = 0) : void
    {
        $this->nestingMargin = $nestingMargin;
    }

    /**
     * Margin to apply between occurrences of image in Step&Repeat
     *
     * @return float|null Margin to apply between occurrences of image in Step&Repeat
     */
    public function getNestingMargin() : ?float
    {
        return $this->nestingMargin;
    }

    /**
     * Toggles Step&Repeat mode that creates independent rows
     *
     * @param bool|null $nestRows Toggles Step&Repeat mode that creates independent rows
     */
    public function setNestRows(?bool $nestRows = false): void
    {
        $this->nestRows = $nestRows;
    }

    /**
     * Toggles Step&Repeat mode that creates independent rows
     *
     * @return bool|null Toggles Step&Repeat mode that creates independent rows
     */
    public function getNestRows() : ?bool
    {
        return $this->nestRows;
    }

    /**
     * Number of pages to print when nesting_mode = METHOD_CUSTOM. Total number
     * of printed copies will be “nb_copies_sr” x “nb_pages_sr”. It will lead to
     * “nb_pages_sr” jobs, each with “nb_copies_sr” nested images.
     *
     * @param int|null $nbPagesStepAndRepeat Number of pages to print when nesting_mode = METHOD_CUSTOM
     */
    public function setNumberOfPagesStepAndRepeat(?int $nbPagesStepAndRepeat = 1) : void
    {
        $this->nbPagesStepAndRepeat = $nbPagesStepAndRepeat;
    }

    /**
     * Number of pages to print when nesting_mode = METHOD_CUSTOM. Total number
     * of printed copies will be “nb_copies_sr” x “nb_pages_sr”. It will lead to
     * “nb_pages_sr” jobs, each with “nb_copies_sr” nested images.
     *
     * @return int|null Number of pages to print when nesting_mode = METHOD_CUSTOM
     */
    public function getNumberOfPagesStepAndRepeat() : ?int
    {
        return $this->nbPagesStepAndRepeat;
    }

    /**
     * Number of copies to nest in one page when nesting_mode = METHOD_CUSTOM.
     * Total number of printed copies will be (nb_copies_sr * nb_pages_sr)
     *
     * @param int|null $nbCopiesStepAndRepeat Number of copies to nest in one page.
     */
    public function setNumberOfCopiesStepAndRepeat(?int $nbCopiesStepAndRepeat = 1) : void
    {
        $this->nbCopiesStepAndRepeat = $nbCopiesStepAndRepeat;
    }

    /**
     * Number of copies to nest in one page when nesting_mode = METHOD_CUSTOM.
     * Total number of printed copies will be (nb_copies_sr * nb_pages_sr)
     *
     * @return int Number of copies to nest in one page.
     */
    public function getNumberOfCopiesStepAndRepeat() : int
    {
        return $this->nbCopiesStepAndRepeat;
    }

    /**
     * Number of copies.
     *
     * @param int|null $numberOfCopies Number of copies.
     */
    public function setNumberOfCopies(?int $numberOfCopies = 1) : void
    {
        $this->numberOfCopies = $numberOfCopies;
    }

    /**
     * Number of copies.
     *
     * @return int Number of copies.
     */
    public function getNumberOfCopies() : int
    {
        return $this->numberOfCopies;
    }

    /**
     * Nesting Mode
     *
     * @param NestingModeOption|null $nestingMode Nesting Mode
     */
    public function setNestingMode(?NestingModeOption $nestingMode = null) : void
    {
        $this->nestingMode = $nestingMode;
    }

    /**
     * Nesting Mode
     *
     * @return NestingModeOption|null Nesting Mode
     */
    public function getNestingMode() : ?NestingModeOption
    {
        return $this->nestingMode;
    }

    /**
     * Page options.
     *
     * @param InPage|null $inPage Page options.
     */
    public function setInPage(?InPage $inPage = null) : void
    {
        $this->inPage = $inPage;
    }

    /**
     * Page options.
     *
     * @return InPage|null Page options.
     */
    public function getInPage() : ?InPage
    {
        return $this->inPage;
    }

    /**
     * Image settings.
     *
     * @param Image $image Image settings.
     */
    public function setImage(Image $image) : void
    {
        $this->image = $image;
    }

    /**
     * Image settings.
     *
     * @return Image Image settings.
     */
    public function getImage() : Image
    {
        return $this->image;
    }

    /**
     * Action selector.
     *
     * @param ActionOption|null $action Action selector.
     */
    public function setAction(?ActionOption $action = null) : void
    {
        $this->action = $action;
    }

    /**
     * Action selector.
     *
     * @return ActionOption|null Action selector.
     */
    public function getAction() : ?ActionOption
    {
        return $this->action;
    }

    /**
     * Print quality selector. Value depends on the printer.
     *
     * @param string $quality Print quality selector. Value depends on the printer.
     */
    public function setQuality(?string $quality = null) : void
    {
        $this->quality = $quality;
    }

    /**
     * Print quality selector. Value depends on the printer.
     *
     * @return string Print quality selector. Value depends on the printer.
     */
    public function getQuality() : ?string
    {
        return $this->quality;
    }

    /**
     * Printer medium selector.
     *
     * @param PaperOption|null $paper Printer medium selector.
     */
    public function setPaper(?PaperOption $paper = null)
    {
        $this->paper = $paper;
    }

    /**
     * Printer medium selector.
     *
     * @return PaperOption Printer medium selector.
     */
    public function getPaper() : ?PaperOption
    {
        return $this->paper;
    }

    /**
     * Loading selector.
     *
     * @param Loading $loading Loading selector.
     */
    public function setLoading(Loading $loading) : void
    {
        $this->loading = $loading;
    }

    /**
     * Loading selector.
     *
     * @return Loading Loading selector.
     */
    public function getLoading() : Loading
    {
        return $this->loading;
    }

    /**
     * Print resolution name
     *
     * @param PrintResolution|null $printResolution
     */
    public function setPrintResolution(?PrintResolution $printResolution = null) : void
    {
        $this->printResolution = $printResolution;
    }

    /**
     * Print resolution name
     *
     * @return PrintResolution Print resolution name
     */
    public function getPrintResolution() : ?PrintResolution
    {
        return $this->printResolution;
    }

    /**
     * Print color mode name.
     *
     * @param string $modeName Print color mode name.
     */
    public function setModeName(?string $modeName = null) : void
    {
        $this->modeName = $modeName;
    }

    /**
     * Print color mode name.
     *
     * @return string Print color mode name.
     */
    public function getModeName() : ?string
    {
        return $this->modeName;
    }

    /**
     * Generates a DOMElement representing the JDFComponent.
     *
     * @param \DOMDocument $dom The DOMDocument use to generate the element.
     *
     * @return \DOMElement Returns the generated DOMElement for the component.
     */
    public function getJDF(\DOMDocument $dom): \DOMElement
    {
        $element = $dom->createElementNS(Configurations::XML_CALDERA_NAMESPACE, 'PrintConfig');

        if (! is_null($this->getModeName())) {
            $child = $dom->createElement('modename');
            $child->appendChild($dom->createTextNode($this->getModeName()));
            $element->appendChild($child);
        }

        if (! is_null($this->getPrintResolution())) {
            $element->appendChild($this->getPrintResolution()->getJDF($dom));
        }

        if (! is_null($this->getLoading())) {
            $element->appendChild($this->getLoading()->getJDF($dom));
        }

        if (! is_null($this->getPaper())) {
            $element->appendChild($this->getPaper()->getJDF($dom));
        }

        if (! is_null($this->getQuality())) {
            $child = $dom->createElement('quality');
            $child->appendChild($dom->createTextNode($this->getQuality()));
            $element->appendChild($child);
        }

        if (! is_null($this->getAction())) {
            $element->appendChild($this->getAction()->getJDF($dom));
        }

        if (! is_null($this->getPrintGab())) {
            $element->appendChild($this->getPrintGab()->getJDF($dom));
        }

        if (! is_null($this->getImage())) {
            $element->appendChild($this->getImage()->getJDF($dom));
        }

        if (! is_null($this->getInPage())) {
            $element->appendChild($this->getInPage()->getJDF($dom));
        }

        if (! is_null($this->getNestingMode())) {
            $element->appendChild($this->getNestingMode()->getJDF($dom));
        }

        if (! is_null($this->getNumberOfCopies())) {
            $child = $dom->createElement('nb_copies');
            $child->appendChild($dom->createTextNode((string) $this->getNumberOfCopies()));
            $element->appendChild($child);
        }

        if (! is_null($this->getNumberOfCopiesStepAndRepeat())) {
            $child = $dom->createElement('nb_copies_sr');
            $child->appendChild($dom->createTextNode((string) $this->getNumberOfCopiesStepAndRepeat()));
            $element->appendChild($child);
        }

        if (! is_null($this->getNumberOfPagesStepAndRepeat())) {
            $child = $dom->createElement('nb_pages_sr');
            $child->appendChild($dom->createTextNode((string) $this->getNumberOfPagesStepAndRepeat()));
            $element->appendChild($child);
        }

        if (! is_null($this->getNestRows())) {
            $child = $dom->createElement('nest_rows');
            $child->appendChild($dom->createTextNode($this->getNestRows() ? 'true' : 'false'));
            $element->appendChild($child);
        }

        if (! is_null($this->getNestingMargin())) {
            $child = $dom->createElement('nesting_margin');
            $child->appendChild($dom->createTextNode((string) $this->getNestingMargin()));
            $element->appendChild($child);
        }

        if (! is_null($this->getPrintOnlyI100())) {
            $child = $dom->createElement('print_only_if_100');
            $child->appendChild($dom->createTextNode($this->getPrintOnlyI100() ? 'true' : 'false'));
            $element->appendChild($child);
        }

        if (! is_null($this->getPrintOnlyIfValue())) {
            $child = $dom->createElement('print_only_if_value');
            $child->appendChild($dom->createTextNode($this->getPrintOnlyIfValue() ? 'true' : 'false'));
            $element->appendChild($child);
        }

        if (! is_null($this->getCropMarks())) {
            $element->appendChild($this->getCropMarks()->getJDF($dom));
        }

        if (! is_null($this->getEnableNestOba())) {
            $child = $dom->createElement('enable_nestoba');
            $child->appendChild($dom->createTextNode($this->getEnableNestOba() ? 'true' : 'false'));
            $element->appendChild($child);
        }

        if (! is_null($this->getNbaFile())) {
            $child = $dom->createElement('nbafile');
            $child->appendChild($dom->createTextNode($this->getNbaFile()));
            $element->appendChild($child);
        }

        if (! is_null($this->getCartouche())) {
            $element->appendChild($this->getCartouche()->getJDF($dom));
        }

        if (! is_null($this->getLogoAnnotation())) {
            $element->appendChild($this->getLogoAnnotation()->getJDF($dom));
        }

        if (! is_null($this->getMarkSetup())) {
            $element->appendChild($this->getMarkSetup()->getJDF($dom));
        }

        if (! is_null($this->getEnableCut())) {
            $child = $dom->createElement('enable_cut');
            $child->appendChild($dom->createTextNode($this->getEnableCut() ? 'true' : 'false'));
            $element->appendChild($child);
        }

        if (! is_null($this->getCutFile())) {
            $element->appendChild($this->getCutFile()->getJDF($dom));
        }

        if (! is_null($this->getInksetFile())) {
            $child = $dom->createElement('inksetfile');
            $child->appendChild($dom->createTextNode($this->getInksetFile()));
            $element->appendChild($child);
        }

        if (! is_null($this->getColorManagement())) {
            $child = $dom->createElement('color_mngmt');
            $child->appendChild($dom->createTextNode((string) $this->getColorManagement()));
            $element->appendChild($child);
        }

        if (! is_null($this->getColorBar())) {
            $element->appendChild($this->getColorBar()->getJDF($dom));
        }

        if (! is_null($this->getColorCorrections())) {
            $child = $dom->createElement('colorcorrections');
            $child->appendChild($dom->createTextNode((string) $this->getColorCorrections()));
            $element->appendChild($child);
        }

        if (! is_null($this->getInkOptimizer())) {
            $child = $dom->createElement('InkOptimizer');
            $child->appendChild($dom->createTextNode((string) $this->getColorCorrections()));
            $element->appendChild($child);
        }

        if (! is_null($this->getCollate())) {
            $element->appendChild($this->getCollate()->getJDF($dom));
        }

        if (! is_null($this->getStepAndRepeat())) {
            $element->appendChild($this->getStepAndRepeat()->getJDF($dom));
        }

        if (! is_null($this->getCut())) {
            $child = $dom->createElement('cut');
            $child->appendChild($dom->createTextNode((string) $this->getCut()));
            $element->appendChild($child);
        }

        if (! is_null($this->getPrinterSpecificConfiguration())) {
            $child = $dom->createElement('Spec_config');
            $child->appendChild($dom->createTextNode((string) $this->getPrinterSpecificConfiguration()));
            $element->appendChild($child);
        }

        return $element;
    }

    /**
     * @param string $printConfig
     * @return PrintConfig
     * @throws JDFException
     */
    public static function fromSavedConfiguration(string $printConfig) : PrintConfig
    {
        $domDocument = new \DOMDocument();
        if (! $domDocument->loadXML($printConfig)) {
            throw new JDFException('String did not contain valid XML.');
        }

        /**
         * @var $printConfigEl \DOMElement
         */
        $printConfigEl = $domDocument->firstChild;

        if ($printConfigEl == null || $printConfigEl->nodeName != 'preset') {
            throw new JDFException(
                'Configuration XML did not start with a preset element.'
            );
        }

        /**
         * @var $printConfig PrintConfig
         */
        $printConfig = self::fromJDFElement($printConfigEl);
        return $printConfig;
    }

    /**
     * Creates a new instance of the IJDFComponent from a DOMElement.
     *
     * @param \DOMElement $element The DOMElement containing the component definition.
     * @return IJDFComponent Returns the Component.
     * @throws JDFException if the DOMElement does not define a valid component descriptor.
     */
    public static function fromJDFElement(\DOMElement $element): IJDFComponent
    {
        $modeName = self::getTagTextValue($element, 'modename', false);
        $resId    = PrintResolution::fromJDFElement($element->getElementsByTagName('res_id')[0]);
        $loading  = Loading::fromJDFElement($element->getElementsByTagName('loading')[0]);
        $paper    = PaperOption::fromJDFElement($element->getElementsByTagName('paper')[0]);
        $quality  = self::getTagTextValue($element, 'quality', false);
        $action   = ActionOption::fromJDFElement($element->getElementsByTagName('action')[0]);

        $printGabEls = $element->getElementsByTagName('printgab');
        $printGab = null;

        if (count($printGabEls) > 0) {
            $printGab = PrintGab::fromJDFElement($printGabEls[0]);
        }

        $imageEls = $element->getElementsByTagName('img');
        $image = null;

        if (count($imageEls) > 0) {
            $image = Image::fromJDFElement($imageEls[0]);
        }

        $inPageEl = $element->getElementsByTagName('in_page');
        $inPage = null;
        if (count($inPageEl) > 0) {
            $inPage = InPage::fromJDFElement($inPageEl[0]);
        }

        $nestingModeEl = $element->getElementsByTagName('nesting_mode');
        $nestingMode = null;
        if (count($nestingModeEl) > 0) {
            $nestingMode = NestingModeOption::fromJDFElement($nestingModeEl[0]);
        }

        $cartouchEl = $element->getElementsByTagName('cartouche');
        $cartouche = null;
        if (count($cartouchEl) > 0) {
            $cartouche = Cartouche::fromJDFElement($cartouchEl[0]);
        }

        $logoAnnotEl = $element->getElementsByTagName('logo_annot');
        $logoAnnot = null;
        if (count($logoAnnotEl) > 0) {
            $logoAnnot = LogoAnnotation::fromJDFElement($logoAnnotEl[0]);
        }

        $markSetupEl = $element->getElementsByTagName('mark_setup');
        $markSetup = null;
        if (count($markSetupEl)) {
            $markSetup = MarkSetup::fromJDFElement($markSetupEl[0]);
        }

        $colorBarEl = $element->getElementsByTagName('colorbar');
        $colorBar = null;

        if (count($colorBarEl) > 0) {
            $colorBar = ColorBar::fromJDFElement($colorBarEl[0]);
        }

        $collateEl = $element->getElementsByTagName('collate');
        $collate = null;

        if (count($collateEl) > 0) {
            $collate = Collate::fromJDFElement($collateEl[0]);
        }

        $stepAndRepeatEl = $element->getElementsByTagName('step_repeat');
        $stepAndRepeat = null;

        if (count($stepAndRepeatEl) > 0) {
            $stepAndRepeat = StepAndRepeat::fromJDFElement($stepAndRepeatEl[0]);
        }

        $cropMarksEl = $element->getElementsByTagName('cropmarks');
        $cropMarks = null;

        if (count($cropMarksEl) > 0) {
            $cropMarks = CropMarks::fromJDFElement($cropMarksEl[0]);
        }

        $cutFileEl = $element->getElementsByTagName('cutfile');
        $cutFile = null;

        if (count($cutFileEl) > 0) {
            $cutFile = CutFile::fromJDFElement($cutFileEl[0]);
        }

        $inksetFileEl = $element->getElementsByTagName('inksetfile');
        $inksetFile = null;

        if (count($inksetFileEl) > 0) {
            $inksetFile = $inksetFileEl[0]->textContent;
        }

        return new PrintConfig(
            $modeName,
            $resId,
            $loading,
            $paper,
            $quality,
            $action,
            $printGab,
            $image,
            $inPage,
            $nestingMode,
            self::getTagIntegerValue($element, 'nb_copies', false, null),
            self::getTagIntegerValue($element, 'nb_copies_sr', false, null),
            self::getTagIntegerValue($element, 'nb_pages_sr', false, null),
            self::getTagBooleanValue($element, 'nest_rows', false, null),
            self::getTagFloatValue($element, 'nesting_margin', false, null),
            self::getTagBooleanValue($element, 'print_only_if_100', false, null),
            self::getTagBooleanValue($element, 'print_only_if_value', false, null),
            self::getTagBooleanValue($element, 'enable_nestoba', false, null),
            self::getTagTextValue($element, 'nbafile', false, null),
            $cartouche,
            $logoAnnot,
            $markSetup,
            self::getTagBooleanValue($element, 'enable_cut', false, null),
            $cutFile,
            self::getTagTextValue($element, 'color_mngmt', false, null),
            $colorBar,
            self::getTagTextValue($element, 'colorcorrections', false, null),
            self::getTagTextValue($element, 'InkOptimizer', false, null),
            $collate,
            self::getTagTextValue($element, 'cut', false, null),
            self::getTagTextValue($element, 'Spec_config', false, null),
            $stepAndRepeat,
            $cropMarks,
            $inksetFile
        );
    }
}
