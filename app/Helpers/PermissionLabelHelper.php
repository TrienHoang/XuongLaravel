<?php

namespace App\Helpers;

class PermissionLabelHelper
{
    public static function label($key)
    {
        $labels = [
            // 👤 User / Role / Permission
            'view_users' => 'Xem người dùng',
            'create_users' => 'Tạo người dùng',
            'edit_users' => 'Chỉnh sửa người dùng',
            'delete_users' => 'Xóa người dùng',
            'assign_roles' => 'Gán vai trò',
            'view_roles' => 'Xem vai trò',
            'edit_roles' => 'Chỉnh sửa vai trò',
            'view_permissions' => 'Xem quyền',

            // 🛍️ Sản phẩm / Danh mục
            'view_products' => 'Xem sản phẩm',
            'create_products' => 'Tạo sản phẩm',
            'edit_products' => 'Chỉnh sửa sản phẩm',
            'delete_products' => 'Xóa sản phẩm',
            'view_categories' => 'Xem danh mục',
            'create_categories' => 'Tạo danh mục',
            'edit_categories' => 'Chỉnh sửa danh mục',
            'delete_categories' => 'Xóa danh mục',

            // 📦 Đơn hàng / Giỏ hàng
            'view_orders' => 'Xem đơn hàng',
            'update_order_status' => 'Cập nhật trạng thái đơn',
            'cancel_orders' => 'Hủy đơn hàng',
            'manage_shipping' => 'Quản lý vận chuyển',

            // 💬 Bình luận / Đánh giá
            'view_comments' => 'Xem bình luận',
            'delete_comments' => 'Xóa bình luận',
            'approve_comments' => 'Duyệt bình luận',

            // 🎁 Coupon / Khuyến mãi
            'view_coupons' => 'Xem mã giảm giá',
            'create_coupons' => 'Tạo mã giảm giá',
            'edit_coupons' => 'Chỉnh sửa mã giảm giá',
            'delete_coupons' => 'Xóa mã giảm giá',

            // ⚙️ Hệ thống / Dashboard
            'access_dashboard' => 'Truy cập bảng điều khiển',
            'manage_settings' => 'Quản lý cài đặt',
            'view_logs' => 'Xem nhật ký hệ thống',
        ];

        return $labels[$key] ?? $key;
    }
}
