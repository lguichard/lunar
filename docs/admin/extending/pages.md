# Extending Pages

You can add and change the behaviour of existing Filament pages. This might be useful if you wish to add a button for 
additional custom functionality.

To extend a page you need to create and register an extension.

For example, the code below will register a custom extension called `MyEditExtension` for the `EditProduct` Filament page.

```php
LunarPanel::registerExtension(new MyEditExtension, EditProduct::class);
```

## Writing Extensions

There are three extension types Lunar provides, these are for Create, Edit and Listing pages.

You will want to place the extension class in your application. A sensible location might be `App\Lunar\MyCreateExtension`.

Once created you will need to register the extension, typically in your app service provider.


## CreatePageExtension

An example of extending a create page.

```php
use Filament\Actions;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Lunar\Admin\Support\Extending\CreatePageExtension;

class MyCreateExtension extends CreatePageExtension
{
    public function headerActions(array $actions): array
    {
        $actions = [
            ...$actions,
            Actions\Action::make('Cancel'),
        ];

        return $actions;
    }

    public function formActions(array $actions): array
    {
        $actions = [
            ...$actions,
            Actions\Action::make('Create and Edit'),
        ];

        return $actions;
    }

    public function beforeCreate(array $data): array
    {
        $data['model_code'] .= 'ABC';
        
        return $data;
    }

    public function beforeCreation(array $data): array
    {
        return $data;
    }

    public function afterCreation(Model $record, array $data): Model
    {
        return $record;
    }
}
```
```php
use Lunar\Admin\Support\Pages\BaseCreateRecord;

class CreateProduct extends BaseCreateRecord
{
    // ...
}
```
```php
// Typically placed in your AppServiceProvider file...
LunarPanel::registerExtension(new MyCreateExtension, CreateProduct::class);
```

## EditPageExtension

An example of extending an edit page.

```php
use Filament\Actions;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Lunar\Admin\Support\Extending\EditPageExtension;

class MyEditExtension extends EditPageExtension
{
    public function headerActions(array $actions): array
    {
        $actions = [
            ...$actions,
            Actions\ActionGroup::make([
                Actions\Action::make('View on Storefront'),
                Actions\Action::make('Copy Link'),
                Actions\Action::make('Duplicate'),
            ])
        ];

        return $actions;
    }

    public function formActions(array $actions): array
    {
        $actions = [
            ...$actions,
            Actions\Action::make('Update and Edit'),
        ];

        return $actions;
    }

    public function beforeFill(array $data): array
    {
        $data['model_code'] .= 'ABC';

        return $data;
    }

    public function beforeSave(array $data): array
    {
        return $data;
    }

    public function beforeUpdate(array $data, Model $record): array
    {
        return $data;
    }

    public function afterUpdate(Model $record, array $data): Model
    {
        return $record;
    }
    
    public function relationManagers(array $managers): array
    {
        return $managers;
    }
}
```
```php
use Lunar\Admin\Support\Pages\BaseEditRecord;

class EditProduct extends BaseEditRecord
{
    // ...
}
```
```php
// Typically placed in your AppServiceProvider file...
LunarPanel::registerExtension(new MyEditExtension, EditProduct::class);
```

## ListPageExtension

An example of extending a list page.

```php
use Filament\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Lunar\Admin\Support\Extending\ListPageExtension;

class MyListExtension extends ListPageExtension
{
    public function headerActions(array $actions): array
    {
        $actions = [
            ...$actions,
            Actions\ActionGroup::make([
                Actions\Action::make('View on Storefront'),
                Actions\Action::make('Copy Link'),
                Actions\Action::make('Duplicate'),
            ]),
        ];

        return $actions;
    }
  
}
```
```php
use Lunar\Admin\Support\Pages\BaseListRecords;

class ListProducts extends BaseListRecords
{
    // ...
}
```
```php
// Typically placed in your AppServiceProvider file...
LunarPanel::registerExtension(new MyListExtension, ListProducts::class);
```

## Extending Pages In Addons

If you are building an addon for Lunar, you may need to take a slightly different approach when modifying forms, etc.

For example, you cannot assume the contents of a form, so you may need to take an approach such as this...

```php
    public function extendForm(Form $form): Form
    {
        $form->schema([
            ...$form->getComponents(true),  // Gets the currently registered components
            TextInput::make('model_code'),
        ]);
        return $form;
    }
```
