<?php 

namespace App\Repositories;

use App\Interfaces\FlashInterface; 
use Laracasts\Flash\FlashNotifier;

/**
 * Class FlashRepository 
 * 
 * @package App\Repositories 
 */
class FlashRepository implements FlashInterface 
{
    /**
     * Flash an message. 
     * 
     * @param  string $message The actual flash message. 
     * @param  string $title   The title for the flash message. 
     * @return FlashNotifier
     */
    public function message(string $message, string $title): FlashNotifier
    {
        return flash('<strong class="mr-2">' . $title . '</strong>' . $message);
    } 

    /**
     * Flash an danger message. 
     * 
     * @param  string $message The actual danger message. 
     * @param  string $title   The title for the flash message defaults to "Danger!"
     * @return FlashNotifier
     */
    public function danger(string $message, string $title = 'Danger!'): FlashNotifier
    {
        return $this->message($title, $message)->danger();
    }

    /**
     * Flash an warning message. 
     * 
     * @param  string $message The actual warning message. 
     * @param  string $title   The title for the flash message defaults to "Warning!"
     * @return FlashNotifier 
     */
    public function warning(string $title, string $message = 'Warning!'): FlashNotifier
    {
        return $this->message($title, $message)->warning();
    }
    
    /**
     * Flash an success message. 
     * 
     * @param  string $message The actual success message. 
     * @param  string $title   The title for the flash message. Defaults to "Success!"
     * @return FlashNotifier
     */
    public function success(string $title, string $message = 'Success!'): FlashNotifier
    {
        return $this->message($title, $message)->success();
    }

    /**
     * Flash an info message. 
     * 
     * @param  string $message The actual info message. 
     * @param  string $title   The title for the flash message. Defaults to "Info!". 
     * @return FlashNotifier
     */
    public function info(string $title, string $message = 'Info!'): FlashNotifier
    {
        return $this->message($title, $message)->info();
    }
}