import { reactive, ref } from "vue";
import AuthService from "@/services/AuthService";
import { GetAuthenticatedUser } from "@/store/auth";
import { ILoginPayload } from "@/Types/Auth";
import GetError, { ResponseError } from "@/Helpers/GetError";

interface ILoginError {
  email?: string[];
  password?: string[];
}

//TODO: Missing return type on function
export function LoginManager() {
  const loggingIn = ref(false);

  //Handle login
  const loginForm = reactive<ILoginPayload>({
    email: "",
    password: "",
  });
  const loginValidator = reactive({
    email: [
      {
        type: "email",
        message: "Please enter a valid email address",
        trigger: ["blur"],
      },
      {
        required: true,
        message: "Email is required",
        trigger: ["blur"],
      },
    ],
    password: [
      {
        type: "string",
        min: 8,
        message: "Password should be at least 8 characters",
        trigger: ["blur"],
      },
      {
        required: true,
        message: "Password is required",
        trigger: ["blur"],
      },
    ],
  });
  const loginError = ref<ILoginError | undefined>(undefined);
  const login = async (
    payload: ILoginPayload = loginForm
  ): Promise<boolean> => {
    loggingIn.value = true;
    try {
      await AuthService.login(payload);
      const authUser = await GetAuthenticatedUser();
      if (authUser) {
        loggingIn.value = false;
        return true;
      } else {
        const apiError = Error(
          "Unable to fetch user after login, check your API settings."
        );
        apiError.name = "Fetch User";
        loggingIn.value = false;
        throw apiError;
      }
    } catch (error) {
      loggingIn.value = false;
      loginError.value = GetError(error as ResponseError);
      return false;
    }
  };

  return {
    login,
    loginForm,
    loginValidator,
    loggingIn,
    loginError,
  };
}
