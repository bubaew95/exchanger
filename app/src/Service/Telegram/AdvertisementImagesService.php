<?php

namespace App\Service\Telegram;

use App\Entity\AdvertisementImages;
use App\Repository\AdvertisementImagesRepository;
use App\Service\TelegramNotifier\Media\InputMediaPhoto;
use App\Service\TelegramNotifier\Model\SendMediaGroup;
use App\Trait\EscapeTrait;
use Longman\TelegramBot\Entities\ServerResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

readonly class AdvertisementImagesService
{
    use EscapeTrait;

    public function __construct(
        private AdvertisementImagesRepository $repository
    ){}

    public function sendGroupImages(int $chatId, array $args): ServerResponse
    {
        $images = $this->getAdvertisementImages($args['prId']);

        $telegramImages = array_map(fn(AdvertisementImages $image) => (
            (new InputMediaPhoto())->upload($image->getImage())
        ), $images);

        $currentImage = current($images);
        $advertisement = $currentImage->getAdvertisement();
        $advertisementName = $this->escapedText($advertisement->getName());

        current($telegramImages)->caption(
            sprintf("🔰 *%s*", $advertisementName)
        )->parseMode();

        return (new SendMediaGroup())
            ->chatId($chatId)
            ->media($telegramImages)
            ->send()
        ;
    }

    public function getAdvertisementImages(int $id): array
    {
        $images = $this->repository->findBy(
            ['advertisement' => $id],
            ['base' => 'DESC', 'id' => 'DESC'],
            10
        );

        if(!$images) {
            throw new NotFoundHttpException('test');
        }

        return $images;
    }
}