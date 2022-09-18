<?php

declare(strict_types=1);

namespace App\Http\Controllers\ReservationTemplate;

use App\Http\Controllers\Controller;
use App\Http\ViewModels\ReservationTemplate\GetList\ReservationTemplateGetListViewModel;
use packages\UseCase\ReservationTemplate\Common\ReservationTemplateModel;
use packages\UseCase\ReservationTemplate\GetList\ReservationTemplateGetListRequest;
use packages\UseCase\ReservationTemplate\GetList\ReservationTemplateGetListUseCaseInterface;

class IndexReservationTemplateController extends Controller
{
    /**
     * 予約テンプレートの一覧表示を行う。
     */
    public function handle(ReservationTemplateGetListUseCaseInterface $interactor)
    {
        $response = $interactor->handle(new ReservationTemplateGetListRequest());

        $templateViewModels = array_map(
            function (ReservationTemplateModel $template): ReservationTemplateGetListViewModel {
                return new ReservationTemplateGetListViewModel(
                    $template->templateId,
                    $template->summary,
                    $template->startAt,
                    $template->endAt,
                    $template->note
                );
            },
            $response->templates
        );

        return view('rooms.templates.index', ['templates' => $templateViewModels]);
    }
}
