<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\Resource;

class SmsNotificationResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                         => $this->resource->id,
            'client_name'                => $this->order->client->name,
            'client_phone'               => $this->recipient,
            'doctor_name'                => $this->order->doctor->name,
            'medcenter_name'             => $this->order->medcenter->name,
            'text'                       => $this->text,
            'order_id'                   => $this->order_id,
            'type'                       => $this->type,
            'delivered_at'               => $this->delivered_at,
            'send_at'                    => isset($this->send_at) ? $this->send_at->format('Y-m-d\TH:i') : null,
            'save_url'                   => $this->save_url,
            'type_description'           => $this->type_description,
            'confirm_status_description' => $this->confirm_status_description,
            'send_status_description'    => $this->send_status_description,
            'confirm_status'             => $this->confirm_status,
            'send_status'                => $this->send_status];
    }
}
