import { ref } from 'vue';
import Swal from 'sweetalert2';

export function useCommonFunction() {

     const HaserrorMsg = ref({});  // Store error messages

        function commonFunction() {
          console.log("Pankaj This is a common function using the Composition API");
        }
      
        const fetchComments_1 = async (quoteid) => {
            
                const response = await axios.get('/get-quote-notes?quote_id='+quoteid);
                return response.data;
        }

          const openNewWindow = (url, width = 800, height = 600) => {
                // Get the dimensions of the screen
              const screenLeft = window.screenLeft !== undefined ? window.screenLeft : window.screen.left;
              const screenTop = window.screenTop !== undefined ? window.screenTop : window.screen.top;
          
              // Get the total screen width and height
              const screenWidth = window.screen.width;
              const screenHeight = window.screen.height;
          
              // Calculate the center position
              const left = screenLeft + (screenWidth / 2) - (width / 2);
              const top = screenTop + (screenHeight / 2) - (height / 2);
          
              // Open the window with the calculated position
              window.open(
                  url, 
                  'NewWindow', 
                  `width=${width},height=${height},top=${top},left=${left},resizable,scrollbars`
              );
          };

          const getddvaluedata = async(ids) => {
              //  const response = await axios.post('/get-quote-notes?quote_id='+quoteid);
              //   return response.data;

              try {
                const response = await axios.post('/get-dd-value', {
                  ddids: ids,
                  _token: document.head.querySelector('meta[name="csrf-token"]') ? document.head.querySelector('meta[name="csrf-token"]').content : ''
                });
                 
                 return response.data;
                // GetSystemDD.value = response.data;
                // console.log('Called getddValue data');
              } catch (error) {
                console.error('Error fetching dropdown values:', error);
              }
          } 

          const clearError = (getHaserrorMsg , field) => {
                 getHaserrorMsg.value = {
                    ...getHaserrorMsg.value,  // Ensure we are updating the reactive object
                    [field]: '',  // Only update the specific field error
                };
            };

          const isNumberKey = (event) => {
            const charCode = event.which ? event.which : event.keyCode;
            if (charCode < 48 || charCode > 57) {
              event.preventDefault();
            }
          };

            const validateFields = (data, rules) => {
                const errors = {};
                let isValid = true;
              
                for (const field in rules) {
                  const value = data[field];
                  const rule = rules[field];
              
                  // Ensure value is a string before calling trim()
                  const valueToCheck = typeof value === 'string' ? value : '';
              
                  if (rule.required && !valueToCheck.trim()) {
                    errors[field] = `${field.charAt(0).toUpperCase() + field.slice(1)} is required.`;
                    isValid = false;
                  } else if (rule.pattern && !rule.pattern.test(valueToCheck)) {
                    errors[field] = rule.message;
                    isValid = false;
                  }
                }
                  
                    return { isValid, errors };
            };

            // Function to make API requests
             const sendData = async (method, endpoint, params = {}) => 
              {
                try {
                  let response;
                  
                  // Choose method and make request
                  if (method.toLowerCase() === 'post') {
                    response = await axios.post(endpoint, {
                      ...params,
                      _token: document.head.querySelector('meta[name="csrf-token"]')?.content || '',
                    });
                  } else if (method.toLowerCase() === 'get') {
                    response = await axios.get(endpoint, {
                      params: {
                        ...params,
                        //_token: document.head.querySelector('meta[name="csrf-token"]')?.content || '',
                      },
                    });
                  } else if (method.toLowerCase() === 'put') {
                    response = await axios.put(endpoint, {
                      ...params,
                      _token: document.head.querySelector('meta[name="csrf-token"]')?.content || '',
                    });
                  }else {
                    throw new Error('Unsupported HTTP method');
                  }
                  // Return response data
                  return response.data;

                } catch (error) {
                  console.error('Error making API request:', error);
                  // Update error messages if needed
                  HaserrorMsg.value = { general: 'An error occurred. Please try again.' };
                  throw error;  // Re-throw error for further handling if needed
                }
              };

            const    createCustomSwal = () => {
                return Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    background: '#e5f2ebe8',
                    color: '#333',
                    showConfirmButton: false,
                    timer: 1500,
                    customClass: {
                        popup: 'custom-swal-popup',
                        title: 'custom-swal-title',
                    },
                    didOpen: () => {
                        const popup = Swal.getPopup();
                        popup.style.borderRadius = '10px';
                    },
                });
              }

              const createErrorCustomSwal = () => {
                return Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    background: 'rgb(240 218 218)',
                    color: '#333',
                    showConfirmButton: false,
                    timer: 2000,
                    customClass: {
                        popup: 'custom-swal-popup',
                        title: 'custom-swal-title-error',
                    },
                    didOpen: () => {
                        const popup = Swal.getPopup();
                        popup.style.borderRadius = '10px';
                    },
                });
              }

              const createConfirm = async (mesg, heading = 'Yes, delete it!') => {
                return await Swal.fire({
                  title: 'Are you sure?',
                  text: mesg,
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonText: heading,
                  cancelButtonText: 'No, cancel',
                  customClass: {
                    popup: 'custom-swal-popup',
                    title: 'custom-swal-title',
                    confirmButton: 'custom-swal-confirm-button',
                    cancelButton: 'custom-swal-cancel-button'
                  },
                  didOpen: () => {
                    const popup = Swal.getPopup();
                    popup.style.borderRadius = '10px';
                  }
                });
              }; 

              const getFunc = () => {
                console.log('Test Call first Time');
              }

              const initialsName = (fullname) => {
                if (!fullname) return ''; // Return empty if no name is provided
          
                const words = fullname.split(' '); // Split the name into words
                const initialsArray = words.map(word => word.charAt(0).toUpperCase()); // Get the first letter of each word
                 return initialsArray.join(''); // Join initials into a single string
              } ;

                const ymdformat = (date) => {
                      const year = date.getFullYear();
                      const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are zero-indexed
                      const day = String(date.getDate()).padStart(2, '0');
                      return `${year}-${month}-${day}`;
               };

              const dsyformat = (dateString) => {
                // Parse the date string to create a Date object
                    const date = new Date(dateString);
                    
                    // Check if the date is valid
                    if (isNaN(date)) {
                      console.error('Invalid date:', dateString);
                      return '';
                    }

                    const day = date.getDate();
                    const month = date.toLocaleString('default', { month: 'short' }); // Get short month name (e.g., 'Nov')
                    const year = date.getFullYear();

                    // Function to get the suffix for the day
                    const getSuffix = (day) => {
                      if (day > 3 && day < 21) return 'th'; // 4th to 20th
                      switch (day % 10) {
                        case 1: return 'st';
                        case 2: return 'nd';
                        case 3: return 'rd';
                        default: return 'th';
                      }
                    };

                    // Return the formatted date
                    return `${day}${getSuffix(day)} ${month} ${year}`;
              };

              const daynameformat = (dateString) => {
                  const date = new Date(dateString);
                  if (isNaN(date)) {
                      console.error('Invalid date:', dateString);
                      return '';
                  }
                  // Use toLocaleString to get the abbreviated day name
                  return date.toLocaleString('en-US', { weekday: 'short' }); // Returns 'Mon', 'Tue', etc.
              };


             
        return {
          commonFunction,
          fetchComments_1,
          openNewWindow,
          getddvaluedata,
          isNumberKey,
          clearError,
          validateFields,
          sendData,
          HaserrorMsg,
          createCustomSwal,
          createErrorCustomSwal,
          createConfirm,
          getFunc,
          initialsName,

          ymdformat,
          dsyformat,
          daynameformat
        };
  }