<?php

namespace App\Enums;

/**
 * The Role enum.
 *
 * @method static self 'ADMIN'()
 */
class Role
{
    const ADMIN = 'admin';
    const SUPER_USER = 'super_user';
    const USER = 'user';

    const ALL = [
        self::ADMIN,
        self::SUPER_USER,
        self::USER,
    ];

    const DETAIL = [
        self::ADMIN =>  [
            'name' => 'Admin',
            'color' => 'alert-primary',
            'description' => [
                'ผู้ใช้งาน : ลงทะเบียนผู้ใช้งาน แก้ไขข้อมูลผู้ใช้งาน เพิ่มผู้ใช้งาน',
                'ฟาร์ม : เพิ่ม แก้ไข',
                'โรงเรือน : เพิ่ม แก้ไข',
                'รุ่นไก่ : เพิ่ม แก้ไข',
                'ข้อมูลประสิทธิภาพ : เพิ่ม แก้ไข',
                'มาตราฐาน : เพิ่ม แก้ไข',
                'ต้นทุน : เพิ่ม แก้ไข',
            ],
            'permission' => [
                'user.read',
                'user.create',
                'user.update',
                'user.delete',
                'user.permission',

                'segment.read',
                'segment.create',
                'segment.update',
                'segment.delete',

                'brand.read',
                'brand.create',
                'brand.update',
                'brand.delete',

                'carmodel.read',
                'carmodel.create',
                'carmodel.update',
                'carmodel.delete',

                'agreement.read',
                'agreement.create',
                'agreement.update',
                'agreement.delete',

                'accounting.receiving.read',
                'accounting.receiving.create',
                'accounting.receiving.update',
                'accounting.receiving.delete',

                'accounting.refunddeposit.read',
                'accounting.refunddeposit.create',
                'accounting.refunddeposit.update',
                'accounting.refunddeposit.delete',

                'accounting.refundbooking.read',
                'accounting.refundbooking.create',
                'accounting.refundbooking.update',
                'accounting.refundbooking.delete',

                'customer.read',
                'customer.create',
                'customer.update',
                'customer.delete',

                'car.read',
                'car.create',
                'car.update',
                'car.delete',

                'partner.read',
                'partner.create',
                'partner.update',
                'partner.delete',


                'report.agreement.read',
                'report.agreement.export',

                'report.carrent.read',
                'report.carrent.export',

            ],
        ],
        self::SUPER_USER => [
            'name' => 'Super User',
            'color' => 'alert-success',
            'description' => [
                'ฟาร์ม : ดูได้อย่างเดียว',
                'โรงเรือน : เพิ่ม แก้ไข',
                'รุ่นไก่ : เพิ่ม แก้ไข',
                'ข้อมูลประสิทธิภาพ : เพิ่ม แก้ไข',
                'ต้นทุน : เพิ่ม แก้ไข',
            ],
            'permission' => [
                'dashboard read',
                'farm read',

                'house create',
                'house read',
                'house update',
                'house delete',

                'generation create',
                'generation read',
                'generation update',
                'generation delete',

                'performance create',
                'performance read',
                'performance update',
                'performance delete',

                'cost create',
                'cost read',
                'cost update',
                'cost delete',
            ],
        ],
        self::USER => [
            'name' => 'User',
            'color' => 'alert-pending',
            'description' => [
                'ฟาร์ม : ดูได้อย่างเดียว',
                'โรงเรือน : ดูได้อย่างเดียว',
                'รุ่นไก่ : ดูได้อย่างเดียว',
                'ข้อมูลประสิทธิภาพ : ดูได้อย่างเดียว'
            ],
            'permission' => [
                'dashboard read',

                'farm read',

                'house read',

                'generation read',

                'performance read',
            ],
        ]
    ];

    //Retrieve a map of enum keys and values.
    public static function map(): array
    {
        return [
            self::ADMIN => 'Admin',
            self::SUPER_USER => 'Super User',
            self::USER => 'User',
        ];
    }

    public static function getDetail($role)
    {
        return self::DETAIL[$role];
    }
}
