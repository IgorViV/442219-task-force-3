<?php
declare(strict_types=1);

namespace Taskforce\utilities;
use Taskforce\utilities\GetPluralForm;

class GetTimePublic
{
    const MINUTE = 60;
    const HOUR = 60;
    const DAY = 24 * self::HOUR;
    const WEEK = 7 * self::DAY;
    const MONTH = 5 * self::WEEK;

    /**
     * Calculates the time elapsed after the publication of the ad
     * @param string $date_public Date of publication of the announcement
     *
     * @return string Past tense
     */
    public static function getTimePublic(string $date_public): string
    {
    
        $diff_date_timestamp = time() - strtotime($date_public);
        $diff_time_public_post = '';
        $remaining_time = ceil($diff_date_timestamp / self::MINUTE);

        switch (true) {
            case ($remaining_time < self::HOUR):
                $diff_time_public_post = "$remaining_time " . GetPluralForm::getPluralForm($remaining_time, 'минута', 'минуты', 'минут') . ' назад';
                break;
            case ($remaining_time >= self::HOUR && $remaining_time < self::DAY):
                $remaining_time = ceil($remaining_time / self::HOUR);
                $diff_time_public_post = "$remaining_time " . GetPluralForm::getPluralForm($remaining_time, 'час', 'часа', 'часов') . ' назад';
                break;
            case ($remaining_time >= self::DAY && $remaining_time < self::WEEK):
                $remaining_time = ceil($remaining_time / self::DAY);
                $diff_time_public_post = "$remaining_time " . GetPluralForm::getPluralForm($remaining_time, 'день', 'дня', 'дней') . ' назад';
                break;
            case ($remaining_time >= self::WEEK && $remaining_time < self::MONTH):
                $remaining_time = ceil($remaining_time / self::WEEK);
                $diff_time_public_post = "$remaining_time " . GetPluralForm::getPluralForm($remaining_time, 'неделя', 'недели', 'недель') . ' назад';
                break;
            default:
                $remaining_time = ceil($remaining_time / self::MONTH);
                $diff_time_public_post = "$remaining_time " . GetPluralForm::getPluralForm($remaining_time, 'месяц', 'месяца', 'месяцев') . ' назад';
        }

        return $diff_time_public_post;
    }
}