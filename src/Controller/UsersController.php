<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Event\Event;
use Cake\View\JsonView;
/**
 * Users Controller
 *
 */
class UsersController extends AppController
{
    public function viewClasses(): array
{
return [JsonView::class];
}

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    // public function initialize(): void
    // {
    //     parent::initialize();
    //     $this->loadComponent('RequestHandler');
    //     $this->loadComponent('Auth', [
    //         'authenticate' => [
    //             'Form' => [
    //                 'fields' => ['username' => 'email', 'password' => 'password']
    //             ]
    //         ],
    //         'loginAction' => [
    //             'controller' => 'Users',
    //             'action' => 'login'
    //         ]
    //     ]);
    //      // Disable CSRF protection for all actions in this controller
    //     $this->eventManager()->off($this->Csrf);
    // }


     public function signup()
     {
         $this->request->allowMethod(['post']);
 
         $user = $this->Users->newEmptyEntity();
         $user = $this->Users->patchEntity($user, $this->request->getData());
 
         if ($this->Users->save($user)) {
             $this->set([
                 'success' => true,
                 'data' => [
                     'message' => 'User created successfully'
                 ],
             ]);
         } else {
             $this->set([
                 'success' => false,
                 'data' => [
                     'message' => 'Failed to create user',
                     'errors' => $user->getErrors(),
                 ],
             ]);
         }
         $this->viewBuilder()->setOption('serialize', ['success', 'data']);
     }
     // UsersController.php

public function login()
{
    if ($this->request->is('post')) {
        $user = $this->Auth->identify();
        if ($user) {
            $this->Auth->setUser($user);
            $token = $this->generateToken(); // Generate access token
            $this->set([
                'success' => true,
                'data' => [
                    'token' => $token,
                    'message' => 'Login successful'
                ],
            ]);
        } else {
            $this->set([
                'success' => false,
                'data' => [
                    'message' => 'Invalid username or password',
                ],
            ]);
        }
        $this->viewBuilder()->setOption('serialize', ['success', 'data']);
    }
}

// UsersController.php

public function logout()
{
    $this->Authentication->logout();
    $this->set([
        'success' => true,
        'data' => [
            'message' => 'Logout successful'
        ],
    ]);
    $this->viewBuilder()->setOption('serialize', ['success', 'data']);
}
// UsersController.php

public function resetPassword()
{
    // Implement password reset logic here
}
// UsersController.php

public function refreshToken()
{
    // Implement token refresh logic here
}



    public function index()
    {
        $query = $this->Users->find();
        $users = $this->paginate($query);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, contain: []);
        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
