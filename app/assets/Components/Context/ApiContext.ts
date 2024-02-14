import {createContext} from "react";
import ServerApi from "../../Server/ServerApi";

export const ApiContext = createContext<ServerApi>(new ServerApi());