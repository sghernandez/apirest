USE [apirest]
GO
/****** Object:  Table [dbo].[Paciente]    Script Date: 05/07/2021 14:50:52 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Paciente](
	[id_Paciente] [int] IDENTITY(1,1) NOT NULL,
	[Paciente_documento] [nvarchar](50) NOT NULL,
	[Paciente_nombre] [nvarchar](50) NULL,
 CONSTRAINT [PK_Paciente] PRIMARY KEY CLUSTERED 
(
	[id_Paciente] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Usuario]    Script Date: 05/07/2021 14:50:53 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Usuario](
	[id_Usuario] [int] IDENTITY(1,1) NOT NULL,
	[Usuario_usuario] [nvarchar](50) NOT NULL,
	[Usuario_password] [nvarchar](70) NOT NULL,
	[Usuario_estado] [nvarchar](50) NOT NULL,
 CONSTRAINT [PK_Usuario] PRIMARY KEY CLUSTERED 
(
	[id_Usuario] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Usuario_token]    Script Date: 05/07/2021 14:50:53 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Usuario_token](
	[id_Usuario_token] [int] IDENTITY(1,1) NOT NULL,
	[Usuario_id] [int] NOT NULL,
	[Usuario_token_token] [nvarchar](50) NULL,
	[Usuario_token_estado] [nvarchar](50) NULL,
	[Usuario_token_fecha] [datetime] NULL,
 CONSTRAINT [PK_Usuario_token] PRIMARY KEY CLUSTERED 
(
	[id_Usuario_token] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
SET IDENTITY_INSERT [dbo].[Paciente] ON 

INSERT [dbo].[Paciente] ([id_Paciente], [Paciente_documento], [Paciente_nombre]) VALUES (1, N'91030210', N'Juan Carlos')
INSERT [dbo].[Paciente] ([id_Paciente], [Paciente_documento], [Paciente_nombre]) VALUES (2, N'91015478', N'Maria Meneses')
INSERT [dbo].[Paciente] ([id_Paciente], [Paciente_documento], [Paciente_nombre]) VALUES (3, N'11245733', N'Karol Mena')
INSERT [dbo].[Paciente] ([id_Paciente], [Paciente_documento], [Paciente_nombre]) VALUES (4, N'11246745', N'Carlos Mario Paez')
SET IDENTITY_INSERT [dbo].[Paciente] OFF
GO
SET IDENTITY_INSERT [dbo].[Usuario] ON 

INSERT [dbo].[Usuario] ([id_Usuario], [Usuario_usuario], [Usuario_password], [Usuario_estado]) VALUES (1, N'usuario1@gmail.com', N'e10adc3949ba59abbe56e057f20f883e', N'Activo')
SET IDENTITY_INSERT [dbo].[Usuario] OFF
GO
SET IDENTITY_INSERT [dbo].[Usuario_token] ON 

INSERT [dbo].[Usuario_token] ([id_Usuario_token], [Usuario_id], [Usuario_token_token], [Usuario_token_estado], [Usuario_token_fecha]) VALUES (1, 1, N'a79e1d684eb4a4d0ff933a4eebff6f42', N'Activo', CAST(N'2021-05-07T21:06:00.000' AS DateTime))
INSERT [dbo].[Usuario_token] ([id_Usuario_token], [Usuario_id], [Usuario_token_token], [Usuario_token_estado], [Usuario_token_fecha]) VALUES (2, 1, N'ce51e93fd00d903b06ab3143944bfc69', N'Activo', CAST(N'2021-05-07T21:10:00.000' AS DateTime))
INSERT [dbo].[Usuario_token] ([id_Usuario_token], [Usuario_id], [Usuario_token_token], [Usuario_token_estado], [Usuario_token_fecha]) VALUES (3, 1, N'2138856fc01cc2284b3159efda9f89af', N'Activo', CAST(N'2021-05-07T21:18:00.000' AS DateTime))
INSERT [dbo].[Usuario_token] ([id_Usuario_token], [Usuario_id], [Usuario_token_token], [Usuario_token_estado], [Usuario_token_fecha]) VALUES (4, 1, N'ff40b0e93eee279902d8fd0b32670f26', N'Activo', CAST(N'2021-05-07T21:38:00.000' AS DateTime))
INSERT [dbo].[Usuario_token] ([id_Usuario_token], [Usuario_id], [Usuario_token_token], [Usuario_token_estado], [Usuario_token_fecha]) VALUES (5, 1, N'9e5fb7c0174d7cade2a698c68ae9b293', N'Activo', CAST(N'2021-05-07T21:41:00.000' AS DateTime))
SET IDENTITY_INSERT [dbo].[Usuario_token] OFF
GO
