<?php

declare(strict_types=1);

namespace App\Http\Controllers\ReservationTemplate;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationTemplate\UpdateRequest;
use packages\Domain\Domain\Room\Exception\NotFoundException;
use packages\UseCase\ReservationTemplate\Update\ReservationTemplateUpdateRequest;
use packages\UseCase\ReservationTemplate\Update\ReservationTemplateUpdateUseCaseInterface;

class UpdateReservationTemplateController extends Controller
{
    /**
     * 予約テンプレートの更新を行う。
     *
     * @param UpdateRequest                             $request
     * @param ReservationTemplateUpdateUseCaseInterface $interactor
     */
    public function handle(UpdateRequest $request, ReservationTemplateUpdateUseCaseInterface $interactor)
    {
        $validated = $request->validated();

        try {
            $response = $interactor->handle(new ReservationTemplateUpdateRequest(
                (int)$validated['template_id'],
                $validated['summary'],
                $validated['start_at'],
                $validated['end_at'],
                $validated['note'] ?? ''
            ));

            return redirect()
                ->route('templates.detail', ['template_id' => $response->getTemplateId()])
                ->with('message', '予約テンプレートの更新が完了しました。');
        } catch (NotFoundException $exception) {
            return redirect()
                ->route('templates.detail', ['template_id' => $validated['template_id']])
                ->with('exception', '対象IDの予約テンプレートが見つかりませんでした。')
                ->withInput($request->all());
        }
    }
}
