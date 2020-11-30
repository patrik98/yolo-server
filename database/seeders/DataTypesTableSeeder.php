<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataType;

class DataTypesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $dataType = $this->dataType('slug', 'users');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'users',
                'display_name_singular' => __('voyager::seeders.data_types.user.singular'),
                'display_name_plural'   => __('voyager::seeders.data_types.user.plural'),
                'icon'                  => 'voyager-person',
                'model_name'            => 'TCG\\Voyager\\Models\\User',
                'policy_name'           => 'TCG\\Voyager\\Policies\\UserPolicy',
                'controller'            => 'TCG\\Voyager\\Http\\Controllers\\VoyagerUserController',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'menus');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'menus',
                'display_name_singular' => __('voyager::seeders.data_types.menu.singular'),
                'display_name_plural'   => __('voyager::seeders.data_types.menu.plural'),
                'icon'                  => 'voyager-list',
                'model_name'            => 'TCG\\Voyager\\Models\\Menu',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'roles');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'roles',
                'display_name_singular' => __('voyager::seeders.data_types.role.singular'),
                'display_name_plural'   => __('voyager::seeders.data_types.role.plural'),
                'icon'                  => 'voyager-lock',
                'model_name'            => 'TCG\\Voyager\\Models\\Role',
                'controller'            => 'TCG\\Voyager\\Http\\Controllers\\VoyagerRoleController',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        /*
         * CUSTOM, NON-VOYAGER TABLES
         */

        $dataType = $this->dataType('slug', 'projects');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'projects',
                'display_name_singular' => __('Project'),
                'display_name_plural'   => __('Projects'),
                'icon'                  => 'voyager-folder',
                'model_name'            => 'App\\Models\\Project',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'project_types');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'project_types',
                'display_name_singular' => __('Project Type'),
                'display_name_plural'   => __('Project Types'),
                'icon'                  => 'voyager-list',
                'model_name'            => 'App\\Models\\ProjectType',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'items');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'items',
                'display_name_singular' => __('Item'),
                'display_name_plural'   => __('Items'),
                'icon'                  => 'voyager-photos',
                'model_name'            => 'App\\Models\\Item',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
                'details'               => [
                    'order_column' => 'id',
                    'order_display_column' => 'id',
                    "order_direction" => "asc",
                ]
            ])->save();
        }

        $dataType = $this->dataType('slug', 'annotations');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'annotations',
                'display_name_singular' => __('Annotation'),
                'display_name_plural'   => __('Annotations'),
                'icon'                  => 'voyager-pen',
                'model_name'            => 'App\\Models\\Annotation',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'annotation_types');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'annotation_types',
                'display_name_singular' => __('Annotation Type'),
                'display_name_plural'   => __('Annotation Types'),
                'icon'                  => 'voyager-list',
                'model_name'            => 'App\\Models\\AnnotationType',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'annotation_attributes');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'annotation_attributes',
                'display_name_singular' => __('Annotation Attribute'),
                'display_name_plural'   => __('Annotation Attributes'),
                'icon'                  => 'voyager-tag',
                'model_name'            => 'App\\Models\\AnnotationAttribute',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
                'details'               => [
                    'order_column' => 'sort',
                    'order_display_column' => 'sort',
                    "order_direction" => "asc",
                ]
            ])->save();
        }

        $dataType = $this->dataType('slug', 'annotation_values');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'annotation_values',
                'display_name_singular' => __('Annotation Value'),
                'display_name_plural'   => __('Annotation Values'),
                'icon'                  => 'voyager-character',
                'model_name'            => 'App\\Models\\AnnotationValue',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'annotation_attribute_values');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'annotation_attribute_values',
                'display_name_singular' => __('Annotation Attribute Value'),
                'display_name_plural'   => __('Annotation Attribute Values'),
                'icon'                  => 'voyager-paperclip',
                'model_name'            => 'App\\Models\\AnnotationAttributeValue',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
                'details'               => [
                    'order_column' => 'sort',
                    'order_display_column' => 'sort',
                    "order_direction" => "asc",
                ]
            ])->save();
        }

        $dataType = $this->dataType('slug', 'view_types');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'view_types',
                'display_name_singular' => __('View Type'),
                'display_name_plural'   => __('View Types'),
                'icon'                  => 'voyager-eye',
                'model_name'            => 'App\\Models\\ViewType',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'points');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'points',
                'display_name_singular' => __('Point'),
                'display_name_plural'   => __('Points'),
                'icon'                  => 'voyager-dot-3',
                'model_name'            => 'App\\Models\\Point',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => 'voyager-dot',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'shapes');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'shapes',
                'display_name_singular' => __('Shape'),
                'display_name_plural'   => __('Shapes'),
                'icon'                  => 'voyager-medal-rank-star',
                'model_name'            => 'App\\Models\\Shape',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }
    }

    /**
     * [dataType description].
     *
     * @param [type] $field [description]
     * @param [type] $for   [description]
     *
     * @return [type] [description]
     */
    protected function dataType($field, $for)
    {
        return DataType::firstOrNew([$field => $for]);
    }
}
