<?php

namespace App\Http\Controllers\Admin\CustomOperations;

use Mail;
use Alert;
use Exception;
use App\Models\Entry;
use App\Mail\Entry\Returned;
use Illuminate\Support\Facades\Route;

trait ModerateOperation
{
    protected function setupModerateRoutes($segment, $routeName, $controller)
    {
        Route::get($segment.'/{id}/moderate', [
            'as'        => $routeName.'.getModerate',
            'uses'      => $controller.'@getModerateForm',
            'operation' => 'moderate',
        ]);
        Route::post($segment.'/{id}/moderate', [
            'as'        => $routeName.'.postModerate',
            'uses'      => $controller.'@postModerateForm',
            'operation' => 'moderate',
        ]);
    }
    
    protected function setupModerateDefaults()
    {
        $this->crud->allowAccess('moderate');

        $this->crud->operation('list', function() {
            $this->crud->addButtonFromView('line', 'moderate', 'view', 'crud::buttons.moderate');  
        });
    }

    public function getModerateForm() 
    {
        $entry = $this->crud->getCurrentEntry();


        $this->crud->hasAccessOrFail('moderate');

        $this->crud->setHeading('Возврат на доработку');
        $this->crud->setSubHeading($entry->user->email);

        $this->data['crud'] = $this->crud;
        $this->data['entry'] = $this->crud->getCurrentEntry();
        $this->data['saveAction'] = $this->crud->getSaveAction();
        $this->data['title'] = 'Возврат на доработку';

        return view('crud::moderate', $this->data);
    }

    public function postModerateForm()
    {
        $this->crud->hasAccessOrFail('moderate');
        $request = $this->crud->validateRequest();

        $entry = $this->crud->getCurrentEntry();
        
        try {
            $entry->notes()->create([
                'note' => $request->note
            ]);

            $entry->update([
                'status' => Entry::STATUS_RETURNED
            ]);

            Mail::to($entry->user->email)->send(new Returned());

            Alert::success('Заявка возвращена на доработку')->flash();

            return redirect(url($this->crud->route));
        } catch (Exception $e) {
            // show a bubble with the error message
            Alert::error("Ошибка, " . $e->getMessage())->flash();

            return redirect()->back()->withInput();
        }
    }
}