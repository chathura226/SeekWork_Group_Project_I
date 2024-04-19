<?php $this->view('admin/admin-header', $data) ?>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/companyMyTasks.styles.css"/>

    <div class="pagetitle column-12">
        <h1>Reports</h1>
        <nav>

            <ul class="breadcrumbs">
                <li class="breadcrumbs__item">
                    <a href="<?= ROOT ?>" class="breadcrumbs__link">Home</a>
                </li>
                <li class="breadcrumbs__item">
                    <a href="<?= ROOT ?>/<?= Auth::getrole() ?>" class="breadcrumbs__link">Dashboard</a>
                </li>
                <li class="breadcrumbs__item">
                    <a href="" class="breadcrumbs__link breadcrumbs__link--active">Reports</a>
                </li>
            </ul>
        </nav>
    </div><!-- End Page Title -->

    <div class="mytasks-wrapper column-12">
        <h1>Type of reports</h1>

        <div class="mytask-tasks height-150">
            <h2>All Tasks Report</h2>
            <h4>Report about all the tasks.</h4>
            <h4>Task status, assigned students and created company details will be reported</h4>
            <h4>Along with the summary of each task details</h4>

            <a href="">
                <button onclick="alltaskreport()" class="details-button">
                    Generate
                    <div class="arrow-wrapper">
                        <div class="arrow"></div>
                    </div>
                </button>
            </a>
        </div>

        <div class="mytask-tasks height-150">
            <h2>All Companies Report</h2>
            <h4>Report about all the companies.</h4>
            <h4>Company Name,userID,contact person first name and last name, address etc. </h4>
            <h4>Along with the summary of each company</h4>

            <a href="">
                <button onclick="allcompanyreport()" class="details-button">
                    Generate
                    <div class="arrow-wrapper">
                        <div class="arrow"></div>
                    </div>
                </button>
            </a>
        </div>

        <div class="mytask-tasks height-150">
            <h2>All Students Report</h2>
            <h4>Report about all the students.</h4>
            <h4>UserID,first name and last name, address etc. </h4>
            <h4>Along with the summary of each student</h4>

            <a href="">
                <button onclick="allstudentreport()" class="details-button">
                    Generate
                    <div class="arrow-wrapper">
                        <div class="arrow"></div>
                    </div>
                </button>
            </a>
        </div>

    </div>


    <script src="https://unpkg.com/jspdf-invoice-template@1.4.0/dist/index.js"></script>

    <script>
        // Function to replace null values with empty strings in an array
        function replaceNullsWithEmptyStrings(array) {
            return array.map(value => value === null ? '-' : value);
        }

        //task array
        var taskArray = <?=$allTasks?>;
        taskArray = taskArray.map(obj => Object.values(obj));

        // Map over the array of arrays and apply the function to each inner array
        taskArray = taskArray.map(innerArray => replaceNullsWithEmptyStrings(innerArray));
        // console.log(taskArray);

        var allcompanyArr = <?=$allCompanies?>;
        allcompanyArr = allcompanyArr.map(obj => Object.values(obj));
        allcompanyArr = allcompanyArr.map(innerArray => replaceNullsWithEmptyStrings(innerArray));


        var allstudentArr = <?=$allStudents?>;
        allstudentArr = allstudentArr.map(obj => Object.values(obj));
        allstudentArr = allstudentArr.map(innerArray => replaceNullsWithEmptyStrings(innerArray));




        function alltaskreport() {
            let props = {
                outputType: jsPDFInvoiceTemplate.OutputType.Save,
                returnJsPDFDocObject: true,
                fileName: "All Tasks Report",
                orientationLandscape: false,
                compress: true,
                // logo: {
                //     src: "https://ibb.co/xHQWQvw",
                //     type: 'PNG', //optional, when src= data:uri (nodejs case)
                //     width: 53.33, //aspect ratio = width/height
                //     height: 26.66,
                //     margin: {
                //         top: 0, //negative or positive num, from the current position
                //         left: 0 //negative or positive num, from the current position
                //     }
                // },
                stamp: {
                    inAllPages: true, //by default = false, just in the last page
                    src: "https://raw.githubusercontent.com/edisonneza/jspdf-invoice-template/demo/images/qr_code.jpg",
                    type: 'JPG', //optional, when src= data:uri (nodejs case)
                    width: 20, //aspect ratio = width/height
                    height: 20,
                    margin: {
                        top: 0, //negative or positive num, from the current position
                        left: 0 //negative or positive num, from the current position
                    }
                },
                business: {
                    name: "SeekWork",
                    address: "123, Colombo Road, Colombo",
                    phone: "(+94) 111 11 11 111",
                    email: "seekwork@seekwork.com",
                    email_1: "info@example.al",
                    website: "www.seekwork.com",
                },
                contact: {
                    label: "Report issued for:",
                    name: "<?=Auth::getfirstName()?> <?=Auth::getlastName()?>",
                    address: "<?=Auth::getaddress()?>",
                    phone: "<?=Auth::getcontactNo()?>",
                    email: "<?=Auth::getemail()?>",
                },
                invoice: {
                    label: "Report #: ",
                    num: 19,
                    invDate: "Report Date: <?=date("Y-m-d H:i:s")?>",
                    invGenDate: "",
                    headerBorder: false,
                    tableBodyBorder: false,
                    header: [
                        {
                            title: "TaskID",

                        },
                        {
                            title: "Title"
                        },
                        {
                            title: "TaskType"
                        },
                        {title: "Value (Rs.)"},
                        {title: "Status"},
                        {title: "CompanyID"},
                        {title: "StudentID"},
                        {title: "CreatedAt"},
                        {title: "Deadline"}
                    ],
                    table: taskArray,
                    additionalRows: [{
                        col1: 'Total:',
                        col2: '145,250.50',
                        col3: 'ALL',
                        style: {
                            fontSize: 14 //optional, default 12
                        }
                    },
                        {
                            col1: 'VAT:',
                            col2: '20',
                            col3: '%',
                            style: {
                                fontSize: 10 //optional, default 12
                            }
                        },
                        {
                            col1: 'SubTotal:',
                            col2: '116,199.90',
                            col3: 'ALL',
                            style: {
                                fontSize: 10 //optional, default 12
                            }
                        }],
                    invDescLabel: "",
                    invDesc: "",
                },
                footer: {
                    text: "The invoice is created on a computer and is valid without the signature and stamp.",
                },
                pageEnable: true,
                pageLabel: "Page ",
            };


            var pdfObject = jsPDFInvoiceTemplate.default(props); //returns number of pages created
            console.log("object created ", pdfObject)
        }
        function allcompanyreport(){

            let props = {
                outputType: jsPDFInvoiceTemplate.OutputType.Save,
                returnJsPDFDocObject: true,
                fileName: "All Companies Report",
                orientationLandscape: false,
                compress: true,
                // logo: {
                //     src: "https://ibb.co/xHQWQvw",
                //     type: 'PNG', //optional, when src= data:uri (nodejs case)
                //     width: 53.33, //aspect ratio = width/height
                //     height: 26.66,
                //     margin: {
                //         top: 0, //negative or positive num, from the current position
                //         left: 0 //negative or positive num, from the current position
                //     }
                // },
                stamp: {
                    inAllPages: true, //by default = false, just in the last page
                    src: "https://raw.githubusercontent.com/edisonneza/jspdf-invoice-template/demo/images/qr_code.jpg",
                    type: 'JPG', //optional, when src= data:uri (nodejs case)
                    width: 20, //aspect ratio = width/height
                    height: 20,
                    margin: {
                        top: 0, //negative or positive num, from the current position
                        left: 0 //negative or positive num, from the current position
                    }
                },
                business: {
                    name: "SeekWork",
                    address: "123, Colombo Road, Colombo",
                    phone: "(+94) 111 11 11 111",
                    email: "seekwork@seekwork.com",
                    email_1: "info@example.al",
                    website: "www.seekwork.com",
                },
                contact: {
                    label: "Report issued for:",
                    name: "<?=Auth::getfirstName()?> <?=Auth::getlastName()?>",
                    address: "<?=Auth::getaddress()?>",
                    phone: "<?=Auth::getcontactNo()?>",
                    email: "<?=Auth::getemail()?>",
                },
                invoice: {
                    label: "Report #: ",
                    num: 19,
                    invDate: "Report Date: <?=date("Y-m-d H:i:s")?>",
                    invGenDate: "",
                    headerBorder: false,
                    tableBodyBorder: false,
                    header: [
                        {
                            title: "UserID",

                        },
                        {
                            title: "CompanyID"
                        },
                        {
                            title: "Company"
                        },

                        {title: "Status"},
                        {title: "First Name"},
                        {title: "Last Name"},
                        {title: "Address"},
                        {title: "Website"}
                    ],
                    table: allcompanyArr,
                    additionalRows: [{
                        col1: 'Total:',
                        col2: '145,250.50',
                        col3: 'ALL',
                        style: {
                            fontSize: 14 //optional, default 12
                        }
                    },
                        {
                            col1: 'VAT:',
                            col2: '20',
                            col3: '%',
                            style: {
                                fontSize: 10 //optional, default 12
                            }
                        },
                        {
                            col1: 'SubTotal:',
                            col2: '116,199.90',
                            col3: 'ALL',
                            style: {
                                fontSize: 10 //optional, default 12
                            }
                        }],
                    invDescLabel: "",
                    invDesc: "",
                },
                footer: {
                    text: "The invoice is created on a computer and is valid without the signature and stamp.",
                },
                pageEnable: true,
                pageLabel: "Page ",
            };


            var pdfObject = jsPDFInvoiceTemplate.default(props); //returns number of pages created
            console.log("object created ", pdfObject)
        }
        function allstudentreport(){

            let props = {
                outputType: jsPDFInvoiceTemplate.OutputType.Save,
                returnJsPDFDocObject: true,
                fileName: "All Students Report",
                orientationLandscape: false,
                compress: true,
                // logo: {
                //     src: "https://ibb.co/xHQWQvw",
                //     type: 'PNG', //optional, when src= data:uri (nodejs case)
                //     width: 53.33, //aspect ratio = width/height
                //     height: 26.66,
                //     margin: {
                //         top: 0, //negative or positive num, from the current position
                //         left: 0 //negative or positive num, from the current position
                //     }
                // },
                stamp: {
                    inAllPages: true, //by default = false, just in the last page
                    src: "https://raw.githubusercontent.com/edisonneza/jspdf-invoice-template/demo/images/qr_code.jpg",
                    type: 'JPG', //optional, when src= data:uri (nodejs case)
                    width: 20, //aspect ratio = width/height
                    height: 20,
                    margin: {
                        top: 0, //negative or positive num, from the current position
                        left: 0 //negative or positive num, from the current position
                    }
                },
                business: {
                    name: "SeekWork",
                    address: "123, Colombo Road, Colombo",
                    phone: "(+94) 111 11 11 111",
                    email: "seekwork@seekwork.com",
                    email_1: "info@example.al",
                    website: "www.seekwork.com",
                },
                contact: {
                    label: "Report issued for:",
                    name: "<?=Auth::getfirstName()?> <?=Auth::getlastName()?>",
                    address: "<?=Auth::getaddress()?>",
                    phone: "<?=Auth::getcontactNo()?>",
                    email: "<?=Auth::getemail()?>",
                },
                invoice: {
                    label: "Report #: ",
                    num: 19,
                    invDate: "Report Date: <?=date("Y-m-d H:i:s")?>",
                    invGenDate: "",
                    headerBorder: false,
                    tableBodyBorder: false,
                    header: [
                        {
                            title: "UserID",

                        },
                        {
                            title: "StudentID"
                        },
                        {title: "Status"},
                        {title: "First Name"},
                        {title: "Last Name"},
                        {title: "Address"},
                        {title: "University"}
                    ],
                    table: allstudentArr,
                    additionalRows: [{
                        col1: 'Total:',
                        col2: '145,250.50',
                        col3: 'ALL',
                        style: {
                            fontSize: 14 //optional, default 12
                        }
                    },
                        {
                            col1: 'VAT:',
                            col2: '20',
                            col3: '%',
                            style: {
                                fontSize: 10 //optional, default 12
                            }
                        },
                        {
                            col1: 'SubTotal:',
                            col2: '116,199.90',
                            col3: 'ALL',
                            style: {
                                fontSize: 10 //optional, default 12
                            }
                        }],
                    invDescLabel: "",
                    invDesc: "",
                },
                footer: {
                    text: "The invoice is created on a computer and is valid without the signature and stamp.",
                },
                pageEnable: true,
                pageLabel: "Page ",
            };


            var pdfObject = jsPDFInvoiceTemplate.default(props); //returns number of pages created
            console.log("object created ", pdfObject)
        }

    </script>
<?php $this->view('admin/admin-footer', $data) ?>