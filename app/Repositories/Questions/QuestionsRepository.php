<?php

namespace Vanguard\Repositories\Questions;


interface QuestionsRepository
{
    /**
     * Paginate registered users.
     *
     * @param $perPage
     * @param null $search
     * @param null $status
     * @return mixed
     */
    public function paginate($perPage, $search = null, $status = null);

    /**
     * Find user by its id.
     *
     * @param $id
     * @return null|User
     */
    public function find($id);

    /**
     * Create new question.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Update user specified by it's id.
     *
     * @param $id
     * @param array $data
     * @return User
     */
    public function update($id, array $data);

    /**
     * Delete user with provided id.
     *
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * Associate account details returned from social network
     * to user with provided user id.
     *
     * @param $userId
     * @param $provider
     * @param SocialUser $user
     * @return mixed
     */
   // public function associateSocialAccountForUser($userId, $provider, SocialUser $user);

    /**
     * Number of users in database.
     *
     * @return mixed
     */
    public function count();

    /**
     * Get latest {$count} users from database.
     *
     * @param $count
     * @return mixed
     */
    public function latest($count = 20);

}