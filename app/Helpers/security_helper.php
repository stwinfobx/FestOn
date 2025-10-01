<?php
    function verifyCsrf(){
        $request = \Config\Services::request();
        $security = \Config\Services::security();
    
        try
        {
                $security->CSRFVerify($request);
        }
        catch (SecurityException $e)
        {
                if (config('App')->CSRFRedirect && ! $request->isAJAX())
                {
                        return redirect()->back()->with('error', $e->getMessage());
                }
    
                throw $e;
        }
    }
    function setCsrf(){
        $request = \Config\Services::request();
        $security = \Config\Services::security();
        $security->CSRFSetCookie($request);
    }