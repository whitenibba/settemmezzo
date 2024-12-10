import { useState } from "react";

let [page,goToPage] = useState(1);
let [pages,setPages] = useState(0);
let [page_size,setPageSize] = useState(defaultPageSize);