<?php

declare(strict_types=1);

namespace App\Http\Controllers\ReservationTemplate;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationTemplate\GetRequest;
use App\Http\ViewModels\ReservationTemplate\Get\ReservationTemplateGetViewModel;
use packages\Domain\Domain\Room\Exception\NotFoundException;
use packages\UseCase\ReservationTemplate\Get\ReservationTemplateGetRequest;
use packages\UseCase\ReservationTemplate\Get\ReservationTemplateGetUseCaseInterface;

class GetReservationTemplateController extends Controller
{
    /**
     * 予約テンプレートの取得を行う。
     *
     * @param GetRequest                             $request
     * @param ReservationTemplateGetUseCaseInterface $interactor
     */
    public function handle(GetRequest $request, ReservationTemplateGetUseCaseInterface $interactor)
    {
        try {
            $response = $interactor->handle(new ReservationTemplateGetRequest((int)$request->validated('template_id')));

            $templateModel = $response->getTemplate();

            $template = new ReservationTemplateGetViewModel(
                $templateModel->templateId,
                $templateModel->summary,
                $templateModel->startAt,
                $templateModel->endAt,
                $templateModel->note
            );

            return view('templates.detail', ['template' => $template]);
        } catch (NotFoundException $exception) {
            return redirect()
                ->route('templates.index')
                ->with('exception', '予約テンプレートが存在しませんでした。');
        }
    }
}
