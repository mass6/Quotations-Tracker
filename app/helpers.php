<?php

function gravatar_url($email)
{
	return 'http://gravatar.com/avatar/' . md5($email) . '?s=40';
}

function link_to_task($task)
{
	return link_to_route('user.tasks.show', $task->title, [$task->user->username, $task->id]);
}

function getUserList()
{
	return User::lists('username', 'id');
}

function isActive($link, $seg = 1)
{
	$segment = Request::segment($seg);
	if ($segment == $link)
		{
			return 'active';
		}
		return '';
}

function getGroups()
{
	// get an indexed array of Sentry groups
    $groups = Sentry::findAllGroups();
    $groupList = array();

    if (count($groups))
    {
    	foreach ($groups as $group) 
    	{
    		$groupList[$group['id']] = $group['name'];
    	}
    	
    	return $groupList;

    }
    return null;

}



function getGroupMemberships($userId, $format = 'text')
{
	// Find the Sentry user using the user id
    $user = Sentry::findUserByID($userId);

    // get an indexed array of Sentry groups
    //$groups = Sentry::findAllGroups();

    // Get the user current group memberships
	$groups = $user->getGroups();

	if (empty($groups)) 
	{
		return '';
	}
    
    // initialize the array to hold the user's group membership results
    $groupMembership = array();

    // // if groups exist
    // if (count($groups))
    // {
    // 	foreach ($groups as $group) 
    // 	{
    // 		// if user in group, add group name to membership array
    // 		if ($user->inGroup($group)) 
    // 		{
    // 			// $groupMembership[] = array(
    // 			// 	'id' => $group['id'], 
    // 			// 	'name' => $group['name']
    // 			// 	);

    // 			$groupMembership['id'][] = $group['id'];
    // 			$groupMembership['name'][] = $group['name'];

    // 		}
    		
    // 	}

	switch ($format) 
	{
	    case 'text':
	    	// return a comma delited text string of group memberships
	    	foreach ($groups as $group) 
	    	{
	    		$groupMembership[] = $group->name;
	    	}
    		return implode(', ', $groupMembership);
	        break;
	    
	    case 'id':
	       // return a comma delited text string of group memberships
	    	foreach ($groups as $group) 
	    	{
	    		$groupMembership[] = $group->id;
	    	}
	    	return $groupMembership;
	        break;

        default:
   			echo "i is not equal to 0, 1 or 2";

	}

    

    // no group memberships
    return false;

    
}

function jsonToArray($jsonArray)
{
    if(isset($jsonArray))
    {
        $jsonArray = json_decode($jsonArray);

        // final array to be returned
        $attributes = array();

        foreach ($jsonArray as $attribute)
        {
            // if only 1 index, add second blank index
            if ( ! is_object($attribute)  ) {
                $attribute = array($attribute => "");
            }

            foreach($attribute as $key => $val)
            {
                $attributes[] = array($key, $val);
            }

        }
        return json_encode($attributes);
    }
    else
        return false;
}