<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Admin\PageNotification
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $begin
 * @property string|null $end
 * @property int $is_active
 * @property bool $one_time
 * @property int $page_filter
 * @property array $filter_pages
 * @property string $content
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read mixed $must_show
 * @property mixed $raw_filter_pages
 * @property-read mixed $try_show
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin\PageNotification whereBegin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin\PageNotification whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin\PageNotification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin\PageNotification whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin\PageNotification whereFilterPages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin\PageNotification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin\PageNotification whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin\PageNotification whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin\PageNotification whereOneTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin\PageNotification wherePageFilter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin\PageNotification whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PageNotification extends Model
{
    protected $table = 'page_notifications';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'begin',
        'end',
        'is_active',
        'one_time',
        'page_filter',
        'filter_pages',
        'raw_filter_pages',
        'content'
    ];

    public $casts = [
        'filter_pages' => 'json',
        'one_time' => 'boolean'
    ];

    public function getRawFilterPagesAttribute()
    {
        return implode("\r\n", $this->filter_pages ?? []);
    }

    public function setRawFilterPagesAttribute($value)
    {
        $this->filter_pages = explode("\r\n", $value);
    }

    public function getTryShowAttribute()
    {
        $mustShow = $this->mustShow;
        if ($mustShow && $this->one_time) {
            $sessionShownNotificationIds = session()->get('shown_notification_ids', []);
            $sessionShownNotificationIds[] = $this->id;
            session()->put('shown_notification_ids', $sessionShownNotificationIds);
        }
        return $mustShow;
    }

    public function getMustShowAttribute()
    {
        $mustShow = true;

        if (!$this->is_active)
            return false;

        $now = now();
        if (isset($this->begin) && $this->begin > $now)
            $mustShow = false;
        if (isset($this->end) && $this->end < $now)
            $mustShow = false;

        $sessionShownNotificationIds = session()->get('shown_notification_ids', []);
        if ($this->one_time && in_array($this->id, $sessionShownNotificationIds))
            $mustShow = false;

        $pageUrl = url()->current();
        if ($this->page_filter == -1 && in_array($pageUrl, $this->filter_pages))
            $mustShow = false;
        else if ($this->page_filter == 1 && !in_array($pageUrl, $this->filter_pages))
            $mustShow = false;

        return $mustShow;
    }
}
