import startPage from "./startPage.js";
// import doSelect from "./doSelect.js";
// import showInsertPage from "./showInsertPage.js";
// import showUpdateList from "./showUpdateList.js";
// import showDeleteList from "./showDeleteList.js";


window.onload=function(){
    document.getElementById("root").innerHTML=startPage();

    // 新增 insert
    document.getElementById("insert").onclick = function(){
        const insertPage = `
        課程編號：<input type="text" id="course_id"><br>
        課程名稱：<input type="text" id="course_name"><br>
        課程描述：<input type="text" id="description"><br>
        教師姓名：<input type="text" id="teacher_name"><br>
        

        <button id="CourseInsert" style=background-color:#49b56d;border-style:outset;border-width:5px;border-color:#49b56d;>新增</button>
        `;
        document.getElementById("content").innerHTML = insertPage;

        document.getElementById("CourseInsert").onclick = function(){
            let data = {
                "course_id": document.getElementById("course_id").value,
                "course_name": document.getElementById("course_name").value,
                "description": document.getElementById("description").value,
                "teacher_name": document.getElementById("teacher_name").value,
            };
            // console.log(data)
        
            axios.post("../server/index.php?action=CourseInsert",Qs.stringify(data))  
            //qs:把一個參數對象格式化為URL的形式，並且用&拼接起來
            //處理URL參數
            .then(res => {
                let response = res['data'];
                let str = response['message'];
                document.getElementById("content").innerHTML = str;
            })
            .catch(err => {
                document.getElementById("content").innerHTML = err; 
            });
    }
    }

    // 修改 update
    document.getElementById("update").onclick = function(){
        // select 全部資料
        axios.get("../server/index.php?action=CourseSelect")
        .then(res => {
            let response = res['data'];
            switch (response['status']) {
                case 200:
                    let rows = response['result'];
                    //做畫面
                    let str = `<table>`;
                    str += "<tr><td></td><td>課程編號</td><td>課程名稱</td><td>課程描述</td><td>教師姓名</td></tr>";
                    rows.forEach(element => {
                        str += "<tr>";
                        str += "<td>" + `<input type="radio" name="course_id" value="` + element['course_id'] + `">` + "</td>";
                        str += "<td>" + element['course_id'] + "</td>";
                        str += "<td>" + element['course_name'] + "</td>";
                        str += "<td>" + element['description'] + "</td>";
                        str += "<td>" + element['teacher_name'] + "</td>";
                        str += "</tr>";
                    });
                    str += `</table>`;
                    str += `<button id="showUpdatePage" style=background-color:#49b56d;border-style:outset;border-width:5px;border-color:#49b56d;>修改</button>`;
                    document.getElementById('content').innerHTML = str;

                    document.getElementById('showUpdatePage').onclick= function(){
                        const id = document.getElementsByName("course_id");
                        let idValue;
                        for(let i=0; i<id.length; i++){
                            if(id[i].checked){
                                idValue = id[i].value;
                            }
                        };
                        let data = {
                            "course_id": idValue,
                        };

                        // select radio 按到的那一筆資料
                        axios.post("../server/index.php?action=CourseSelect",Qs.stringify(data))
                        .then(res => {
                            let response = res['data'];
                            const row = response['result'][0];
                            //做畫面
                            const updatePage = `
                                <div id="course_id">` + row['course_id'] + `</div>
                                <input type="text" id="course_name" value="` + row['course_name'] + `">
                                <input type="text" id="description" value="` + row['description'] + `">
                                <input type="text" id="teacher_name" value="` + row['teacher_name'] + `">
                                
                                <button id="doupdate" style=background-color:#49b56d;border-style:outset;border-width:5px;border-color:#49b56d;>修改</button>
                            `;
                            document.getElementById("content").innerHTML = updatePage;
                            

                            document.getElementById("doupdate").onclick = function(){
                                let data = {
                                    "course_id": document.getElementById("course_id").innerText,
                                    "course_name": document.getElementById("course_name").value,
                                    "description": document.getElementById("description").value,
                                    "teacher_name": document.getElementById("teacher_name").value,
                                };
                                
                                axios.post("../server/index.php?action=CourseUpdate",Qs.stringify(data))
                                .then(res => {
                                    let response = res['data'];
                                    let str = response['message'];
                                    document.getElementById("content").innerHTML = str;
                                })
                                .catch(err => {
                                    document.getElementById("content").innerHTML = err; 
                                })
                            }
                        })
                        .catch(err => {
                            console.error(err); 
                        });
                    }
                    break;
                default:
                    document.getElementById('content').innerHTML = response['message'];
                    break;
            }
        })
        .catch(err => {
            console.error(err); 
        });
        
    };
    
    // 刪除 delete
    document.getElementById("delete").onclick = function(){
        const id = document.getElementsByName("course_id");
        axios.get("../server/index.php?action=CourseSelect")
            .then(res => {
                let response = res['data'];
                if (response.status == 200) {
                    let rows = response.result;
                    let str = `<table>`;
                    str += "<tr><td></td><td>課程代號</td><td>課程名稱</td><td>課程描述</td><td>教師姓名</td></tr>";
                    rows.forEach(element => {
                        str += "<tr>";
                        str += "<td>" + `<input type="radio" name="course_id" value="` + element['course_id'] + `">` + "</td>";
                        str += "<td>" + element['course_id'] + "</td>";
                        str += "<td>" + element['course_name'] + "</td>";
                        str += "<td>" + element['description'] + "</td>";
                        str += "<td>" + element['teacher_name'] + "</td>";
                        str += "</tr>";
                    });
                    str += `</table>`;
                    str += `<button id="dodelete" style=background-color:#49b56d;border-style:outset;border-width:5px;border-color:#49b56d;>刪除</button>`;
                    document.getElementById('content').innerHTML = str;

                    document.getElementById("dodelete").onclick = function(){
                        const id = document.getElementsByName("course_id");
                        let idValue;
                        for(let i=0; i<id.length; i++){
                            if(id[i].checked){
                                idValue = id[i].value;
                            }
                        };
                        let data = {
                            "course_id": idValue,
                        };

                        axios.post("../server/index.php?action=CourseDelete", Qs.stringify(data))
                            .then(res => {
                                let response = res['data'];
                                document.getElementById("content").innerHTML = response['message'];
                            })
                            .catch(err => {
                                console.error(err); 
                            });
                    };
                } else {
                    document.getElementById('content').innerHTML = response['message'];
                }
            })
            .catch(err => {
                console.error(err); 
            });
    }
    

    // 查詢 select
    document.getElementById("select").onclick=function(){
        
        axios.get("../server/index.php?action=CourseSelect")
        .then(res => {
            console.log(res);
            
            const response = res['data'];
            
            
            
            let str;
            if (response.status == 200) {
                
            const rows = response.result;
            str = "<table>";
            str += "<tr><td>課程編號</td><td>課程名稱</td><td>課程描述</td><td>教師姓名</td></tr>";
            rows.forEach(element => {
                str += "<tr>";
                str += "<td>" + element.course_id + "</td>";
                str += "<td>" + element.course_name + "</td>";
                str += "<td>" + element.description + "</td>";
                str += "<td>" + element.teacher_name + "</td>";
                str += "</tr>";
            });
            str += "</table>";
            } else {
            str = response.message;
            
            }
            document.getElementById("content").innerHTML = str;
        })
        .catch(err => {
            document.getElementById("content").innerHTML = err;
        });
    }
}
