const defaultPageSize=3;

import { useState } from "react";
import "session.js";
import "pagination.js";


async function postData(url = "", toSend ) {
    const response = await fetch(url, {
      method: "POST", 
      mode: "cors", 
      cache: "no-cache", 
      credentials: "include", 
      headers: {
        "Content-Type": "application/json"
      },
      redirect: "follow", 
      referrerPolicy: "no-referrer", 
      body: JSON.stringify(toSend), 
    });
    const data = await response.json();
    return  data;
}