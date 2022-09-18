<?php

declare(strict_types=1);

namespace App\Http\Controllers\Reservation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reservation\RegisterRequest;
use App\Http\Requests\Reservation\ShowRegisterRequest;
use App\Http\ViewModels\ReservationTemplate\GetList\ReservationTemplateGetListViewModel;
use packages\Domain\Domain\Reservation\Exception\PeriodicDuplicationException;
use packages\Domain\Domain\Room\Exception\NotFoundException;
use packages\UseCase\Reservation\Register\ReservationRegisterRequest;
use packages\UseCase\Reservation\Register\ReservationRegisterUseCaseInterface;
use packages\UseCase\ReservationTemplate\Common\ReservationTemplateModel;
use packages\UseCase\ReservationTemplate\GetList\ReservationTemplateGetListRequest;
use packages\UseCase\ReservationTemplate\GetList\ReservationTemplateGetListUseCaseInterface;

class RegisterReservationController extends Controller
{
    /**
     * 登録画面を表示する。
     *
     * @param ShowRegisterRequest                        $request
     * @param ReservationTemplateGetListUseCaseInterface $interactor
     */
    public function create(ShowRegisterRequest $request, ReservationTemplateGetListUseCaseInterface $interactor)
    {
        $roomId = $request->validated('room_id');

        $detailUrl = sprintf('/rooms/show/%s', $roomId);

        $response = $interactor->handle(new ReservationTemplateGetListRequest());

        $templates = array_map(
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

        return view('rooms.reservations.register', [
            'room_id' => $roomId,
            'detail_url' => $detailUrl,
            'templates' => $templates,
        ]);
    }

    /**
     * 予約の登録を実行する。
     *
     * @param RegisterRequest                     $request
     * @param ReservationRegisterUseCaseInterface $interactor
     */
    public function handle(RegisterRequest $request, ReservationRegisterUseCaseInterface $interactor)
    {
        $validated = $request->validated();

        try {
            $response = $interactor->handle(
                new ReservationRegisterRequest(
                    $validated['room_id'],
                    $validated['summary'],
                    $validated['start_at'],
                    $validated['end_at'],
                    $validated['note'] ?? '' // noteはnullの可能性がある
                )
            );
            $url = '/rooms/show/' . $response->getReservation()->roomId;

            return redirect($url)->with('message', '予約の登録が完了しました。');
        } catch (NotFoundException $exception) {
            return redirect()
                ->route('reservations.register', ['room_id' => $validated['room_id']])
                ->with('exception', '対象の会議室が存在しませんでした。')
                ->withInput($request->all());
        } catch (PeriodicDuplicationException $exception) {
            return redirect()
                ->route('reservations.register', ['room_id' => $validated['room_id']])
                ->with('exception', 'すでに予約が入っています。')
                ->withInput($request->all());
        }
    }
}
