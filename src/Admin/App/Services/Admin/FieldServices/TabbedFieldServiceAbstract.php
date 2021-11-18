<?php

namespace App\Services\Admin\FieldServices;

use App\Entity\Form\FieldGroup;
use App\Models\ModelAbstract;
use Illuminate\View\View;

abstract class TabbedFieldServiceAbstract implements FieldServiceInterface
{
    public ModelAbstract|null $row;

    /**
     * @return TabbedFieldServiceTab[]
     */
    abstract protected function getTabs(): array;

    public function getFields(): array
    {
        $tabs = $this->getTabs();
        $groupInstances = [];
        $activeGroup = true;

        foreach ($tabs as $tab) {
            $groupCode = $tab->getCode();

            if (!empty($tab->getFields())) {
                $groupFields = $tab->getFields();
            } else {
                $groupFields = $tab->getView();
            }

            $groupInstance = new FieldGroup($groupFields, $groupCode, [
                'tabTitle'  => $groupCode,
                'noBorders' => true,
                'activeTab' => $groupCode == $activeGroup,
            ]);

            $activeGroup = false;

            foreach ($tab->getOptions() as $codeOptions => $valueOption) {
                $groupInstance->setOption($codeOptions, $valueOption);
            }

            if ($groupFields instanceof View) {
                $groupInstance->setIsHtml(true);
            }

            $groupInstances[] = $groupInstance;
        }

        $rootGroup = new FieldGroup($groupInstances, 'root', [
            'tab' => true,
            'noBorders' => true,
        ]);

        return [$rootGroup];
    }

    public function setRow(ModelAbstract|null $row = null): static
    {
        $this->row = $row;

        return $this;
    }

}
